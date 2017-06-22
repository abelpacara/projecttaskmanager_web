<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenances extends CI_Controller {
    ####################################################################

    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        $this->load->library('template');

        $this->load->model('model_template');

        $this->load->model('model_maintenances');
        $this->load->model('model_inventories');

        $this->load->helper(array('form', 'url'));
        $this->load->helper("my_views");
        $this->load->helper("my_dates");
        $this->load->helper("my_files");

        $this->load->library('form_validation');
        $this->load->library('ciqrcode');
    }

    ####################################################################

    public function maintenance_add() {
        $array_messages = array();
        $location_id = NULL;
        if (isset($_REQUEST['location_id']) AND strcasecmp($_REQUEST['location_id'], "") != 0) {
            $location_id = $_REQUEST['location_id'];
        }


        if (isset($_REQUEST['btn_save'])) {

            $list_id_kardexes = array();
            if (isset($_REQUEST['list_id_kardexes'])) {
                $list_id_kardexes = $_REQUEST['list_id_kardexes'];
            }


            $maintenance_data['location_id'] = $_REQUEST['location_id'];
            $maintenance_data['maintenance_description'] = $_REQUEST['maintenance_description'];

            list($day, $month, $year) = explode("/", $_REQUEST['maintenance_register_date']);

            $maintenance_data['maintenance_register_date'] = $year . "-" . $month . "-" . $day;

            $id_maintenance = $this->model_maintenances->maintenance_add($maintenance_data);


            for ($i = 0; $i < count($list_id_kardexes); $i++) {



                $kardex_status_data['kardex_id'] = $list_id_kardexes[$i];
                $kardex_status_data['maintenance_id'] = $id_maintenance;
                $kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value_' . $list_id_kardexes[$i]];
                $kardex_status_data['kardex_status_register_date'] = $year . "-" . $month . "-" . $year;


                $kardex_status_data['location_id'] = $_REQUEST['location_id_' . $list_id_kardexes[$i]];

                $this->model_inventories->kardex_status_add($kardex_status_data);
            }
            $post_type_selectable_id = $this->model_template->get_id_selectable_by("post_type", "file");
            /*
             *  $pre_data_file = array("type_select_id" => $type_object_id,
              "user_id" => $user_id,
              "company_id" => $company_id,
              'parent_id' => $comment_id,
              "project_id" => $project_id);
             */

            $pre_data_file['parent_id'] = $id_maintenance;
            $pre_data_file['post_type_selectable_id'] = $post_type_selectable_id;

            $user_role['user_id'] = 1;
            $user_role['id_user_role'] = 1;

            $this->upload_post_file_batch($pre_data_file, "comment", $array_messages, $user_role);
        }

        $view_data['maintenance_register_date'] = $maintenance_register_date = date('d/m/Y', strtotime($this->model_inventories->get_system_time()));

        $view_data['list_kardexes'] = array();

        if (isset($_REQUEST['location_id']) AND strcasecmp($_REQUEST['location_id'], "") != 0) {
            $view_data['list_kardexes'] = $this->model_inventories->get_list_kardexes_full($_REQUEST['location_id']);
        }


        //$view_data['list_locations'] = $this->model_maintenances->get_list_locations();
        $list_locations = array();
        $this->model_inventories->generate_list_locations_tree($list_locations);
        $view_data['list_locations'] = $list_locations;


        $view_data['list_kardexes_status_values'] = $this->model_maintenances->get_list_table_enum_column_values("kardexes_status", "kardex_status_value");



        $list_maintenances = $this->model_maintenances->get_list_maintenances($location_id);


        for ($i = 0; $i < count($list_maintenances); $i++) {
            $list_maintenances[$i]['list_kardexes'] = $this->model_maintenances->get_list_kardexes_by($list_maintenances[$i]['id_maintenance']);
            $list_maintenances[$i]['list_attachment_files'] = $list_attachment_files = $this->model_template->get_list_attachment_files($list_maintenances[$i]['id_maintenance']);
        }

        $view_data['list_maintenances'] = $list_maintenances;




        $view_data['max_upload_filesize'] = $this->template->max_upload_filesize;
        $view_data['max_total_send_filesize_mb'] = $this->template->max_total_send_filesize_mb;


        $this->load->view('template/header');
        $this->load->view('maintenances/maintenance_add', $view_data);
        $this->load->view('template/footer');
    }

    #############################################################################

    private function upload_post_file_batch($pre_data, $parent_type_post = "comment", & $array_messages = null, $user_role) {
        $quantity_files = $_REQUEST['quantity_files'];

        if ($quantity_files > 0) {
            $path_directory = "." . $this->config->item("uri_" . $parent_type_post . "_files") . "/" . $pre_data['parent_id'];

            create_directory($path_directory);
            $view_labels = $this->lang->line('coco_pm_header_view_labels');

            $total_filesize = 0;

            for ($i = 1; $i <= $quantity_files; $i++) {
                $source_file_name = 'file_' . $i;
                $total_filesize += $_FILES['file_' . $i]['size'];

                if (isset($_FILES['file_' . $i]['name']) AND strcasecmp($_FILES['file_' . $i]['name'], "") != 0) {
                    $total_filesize += $_FILES['file_' . $i]['size'];

                    if ($total_filesize <= $this->template->max_total_send_filesize) {
                        $destination_file_name = $_FILES['file_' . $i]['name'];
                        $this->template->upload_file($path_directory, $destination_file_name, $source_file_name, $array_messages);

                        $pre_data['post_title'] = get_filename_uploaded($_FILES['file_' . $i]['name']);

                        $file_id = $this->model_template->add_post($pre_data, "uploaded");
                        #----------------------------------------------------------------
                        $data_user_post = array("user_id" => $user_role['user_id'],
                            "user_role_id" => $user_role['id_user_role'],
                            "post_id" => $file_id);
                        $this->model_template->add_user_post($data_user_post, "uploaded");

                        #----------------------------------------------------------------
                    } else {
                        $array_messages[] = $msg = $view_labels['msg_filesize_part1'] .
                                $total_filesize . $view_labels['msg_filesize_part2'] .
                                $this->template->max_total_send_filesize .
                                $total_filesize . $view_labels['msg_filesize_part3'];
                    }
                }
            }
        }
    }

    ####################################################################

    public function index() {
        $this->load->view('welcome_message');
    }

    ####################################################################

    public function report_form() {

        if (isset($_REQUEST['btn_generate'])) {
            $this->report($_REQUEST['location_id'], spanish_date_to_mysql($_REQUEST['maintenance_start_register_date']), spanish_date_to_mysql($_REQUEST['maintenance_end_register_date']));
        }

        $list_locations = array();
        $this->model_maintenances->generate_list_locations_tree($list_locations);
        $view_data['list_locations'] = $list_locations;


        $this->load->view('template/header');
        $this->load->view('maintenances/report_form', $view_data);
        $this->load->view('template/footer');
    }

    ####################################################################

    private function report($location_id, $maintenance_start_register_date, $maintenance_end_register_date) {
        $this->load->library('Pdf');
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = "REPORTE GENERAL DE SOPORTE Y MANTENIMIENTO";
        /*
          $obj_pdf->SetTitle($title);
          $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
          $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
          $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
          $obj_pdf->SetDefaultMonospacedFont('helvetica');
          $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
          $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
          $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
          $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          $obj_pdf->SetFont('helvetica', '', 9);
          $obj_pdf->setFontSubsetting(false);
         */
        $obj_pdf->AddPage('L', 'A4');

        ob_start();
        ?>


        <div id="logo_container" style="width: 200px; height: 100px">
            <a class="navbar-brand" href="#">
                <img id="logo" src='<?php echo base_url("public/images/logo.png"); ?>'/>
            </a>
        </div>
        <h1>REPORTE GENERAL DE SOPORTE Y MANTENIMIENTO</h1>
        <?php
        $list_maintenances = $this->model_maintenances->get_list_maintenances($location_id, $maintenance_start_register_date, $maintenance_end_register_date);

        for ($i = 0; $i < count($list_maintenances); $i++) {
            $list_maintenances[$i]['list_kardexes'] = $this->model_maintenances->get_list_kardexes_by($list_maintenances[$i]['id_maintenance']);
        }

        $view_data['list_maintenances'] = $list_maintenances;
        ?>


        <table border="1">

            <tr bgcolor="#cccccc">
                <th width="3%"  style="text-align: center; font-weight: bold;">#</th>
                <th width="30%" style="text-align: center; font-weight: bold;">DESCRIPCION</th>
                <th width="10%" style="text-align: center; font-weight: bold;">FECHA</th>
                <th width="10%" style="text-align: center; font-weight: bold;">LOCALIDAD</th>
                <th width="47%" style="text-align: center; font-weight: bold;">EQUIPOS</th>
            </tr>

            <?php
            for ($i = 0; $i < count($list_maintenances); $i++) {
                ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $list_maintenances[$i]['maintenance_description'] ?></td>
                    <td><?php echo $list_maintenances[$i]['maintenance_register_date'] ?></td>
                    <td><?php echo $list_maintenances[$i]['location_name'] ?></td>
                    <td>
                        <?php //print_r($list_maintenances[$i]['list_kardexes']) ?>

                        <table border="1">
                            <tr bgcolor="#cccccc">
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Codigo</th>
                                <th>Serial</th>
                                <th>Estado</th>
                                <th>Localidad</th>
                                <th>Ultimo cambio en</th>
                            </tr>
                            <?php
                            $list_maintenances_kardexes = $list_maintenances[$i]['list_kardexes'];
                            for ($k = 0; $k < count($list_maintenances_kardexes); $k++) {
                                ?>
                                <tr>
                                    <td><?php echo $list_maintenances_kardexes[$k]['id_kardex_status'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['inventory_category_name'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['inventory_mark'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['inventory_model'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['kardex_code'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['kardex_serial'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['kardex_status_value'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['location_name'] ?></td>
                                    <td><?php echo $list_maintenances_kardexes[$k]['kardex_status_register_date'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>


                        </table>


                    </td>
                </tr>
                <?php
            }
            ?>
        </table>



        <?php
        // we can have any view part here like HTML, PHP etc
        $content = ob_get_contents();
        ob_end_clean();


        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output('output.pdf', 'I');
    }

}
