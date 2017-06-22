<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
<?php
$url_timthumb = base_url() . "public/timthumb.php";
?>
<a href="<?php echo $url_timthumb ?>">
    timthumb
</a>
<script>
    $(document).ready(function() {

        $(".selector").click(function() {

            var id = $(this).attr('id');

            if ($("#" + id).is(':checked')) {
                $('#selected_' + id).removeClass("ptm_opacity_user_member");
            } else
            {
                $('#selected_' + id).addClass("ptm_opacity_user_member");
            }
        });
    });
</script>
<script>
    $(function() {

        $("#maintenance_register_date").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, firstDay: 1});
    });
    $(function() {
        //$('.style_mask').customStyle();
    });
</script>


<script>
    $(document).ready(function() {
        $(".delete_file").click(function() {

            var id_deleter = $(this).attr('id');

            $('#row_id_' + id_deleter).toggleClass("over_row_time");
        });
    });

</script>
<?php
echo form_open_multipart($this->uri->uri_string());
?>

<?php
$quantity_files = 3;
?>
<input type="hidden" id="quantity_files" name="quantity_files" value="<?php echo $quantity_files ?>"/>

<script>
    $(document).ready(function() {

        $('#add_file').click(function() {

            var quantity_files = $('#quantity_files').attr('value');
            quantity_files++;
            $('#quantity_files').attr('value', quantity_files);

            var str_append = "";
            str_append += "<tr>";
            str_append += "<td class='text_label_project'><?php echo $view_labels['new_attachment_file'] ?>" + quantity_files + ":</td>";
            str_append += "<td  style='white-space: nowrap'>";
            str_append += "<input type='file' name='file_" + quantity_files + "' class='pm_text_field file_input' size='50'/>";
            str_append += "&nbsp;<?php echo $max_upload_filesize ?> MB max per file";
            str_append += "</td>";
            str_append += "</tr>";

            $('#entries').append(str_append);

            show_filesize_restrict(".file_input", <?php echo $max_total_send_filesize_mb ?>, '#current_filesizes');
        });


        //binds to onchange event of your input field
        show_filesize_restrict(".file_input", <?php echo $max_total_send_filesize_mb ?>, '#current_filesizes');


    });


</script>
</head>


<div id="container">
    <h1>Registrar Mantenimiento</h1>

    <div id="body">

        <?php
        echo form_open_multipart($this->uri->uri_string());
        ?>
        <table>
            <tr>
                <td>Seleccione Localidad</td>
                <td>

                    <?php
                    $location_id_selected = "";
                    if (isset($_REQUEST['location_id'])) {
                        $location_id_selected = $_REQUEST['location_id'];
                    }

                    echo get_display_locations_tree($list_locations, $name = "location_id", $location_id_selected, $onchange = TRUE);
                    ?>



                </td>
            </tr>
            <?php
            if (isset($_REQUEST['location_id'])) {
                ?>

                <tr>
                    <td>Fecha</td>
                    <td>

                        <input id="maintenance_register_date" value="<?php echo $maintenance_register_date ?>" name="maintenance_register_date" readonly="true" id="maintenance_register_date" class="arrow_drowpdown"/>
                    </td>
                </tr>
            <?php }
            ?>


        </table>


        <table id="#entries">
            <tr>
                <td>

                    <style>
                        .device_item{
                            float:left;
                            padding: 5px;
                            border: 1px solid;
                            margin: 3px;

                        }
                    </style>


                    <?php for ($i = 0; $i < count($list_kardexes); $i++) { ?>
                        <div  id="selected_<?php echo $i ?>"  class="device_item ptm_opacity_user_member overlay">
                            <table>
                                <tr>

                                    <td>
                                        <input type="checkbox"  id="<?php echo $i ?>" class="selector" name="list_id_kardexes[]" value="<?php echo $list_kardexes[$i]['id_kardex'] ?>" />
                                    </td>
                                    <td>
                                        # <?php echo $i + 1 ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tipo</th>
                                    <td><?php echo $list_kardexes[$i]['inventory_category_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Marca</th>
                                    <td><?php echo $list_kardexes[$i]['inventory_mark'] ?></td>
                                </tr>
                                <tr>
                                    <th>Modelo</th>
                                    <td><?php echo $list_kardexes[$i]['inventory_model'] ?></td>
                                </tr>
                                <tr>
                                    <th>Codigo</th>
                                    <td><?php echo $list_kardexes[$i]['kardex_code'] ?></td>
                                </tr>
                                <tr>
                                    <th>Serial</th>
                                    <td><?php echo $list_kardexes[$i]['kardex_serial'] ?></td>
                                </tr>
                                <tr>
                                    <th>Ultimo cambio en</th>
                                    <td><?php echo date("d-m-Y", strtotime($list_kardexes[$i]['kardex_status_register_date'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <select name="kardex_status_value_<?php echo $list_kardexes[$i]['id_kardex'] ?>">
                                            <option value="">Estado kardex ...</option>
                                            <?php
                                            for ($j = 0; $j < count($list_kardexes_status_values); $j++) {
                                                ?>
                                                <option value="<?php echo $list_kardexes_status_values[$j] ?>"

                                                        <?php
                                                        if (strcasecmp($list_kardexes[$i]['kardex_status_value'], $list_kardexes_status_values[$j]) == 0) {
                                                            echo " SELECTED ";
                                                        }
                                                        ?>

                                                        >
                                                            <?php echo $list_kardexes_status_values[$j] ?>
                                                </option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <th>Localidad</th>
                                    <td>


                                        <select name="location_id_<?php echo $list_kardexes[$i]['id_kardex'] ?>">
                                            <option value="">Localizacion ...</option>
                                            <?php
                                            for ($j = 0; $j < count($list_locations); $j++) {
                                                ?>
                                                <option value="<?php echo $list_locations[$j]['id_location'] ?>"

                                                        <?php
                                                        if (strcasecmp($list_kardexes[$i]['location_name'], $list_locations[$j]['location_name']) == 0) {
                                                            echo " SELECTED ";
                                                        }
                                                        ?>

                                                        >
                                                            <?php echo $list_locations[$j]['location_name'] ?>
                                                </option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>

                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>




                </td>
            </tr>

            <?php
            if (isset($_REQUEST['location_id'])) {
                ?>
                <tr>
                    <td colspan="2">
                        <textarea name="maintenance_description" cols="50" rows="3" placeholder="descripcion de soporte y mantenimiento general"></textarea>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= $quantity_files; $i++) {
                ?>
                <tr>
                    <td class="text_label_project" style="white-space: nowrap">Nuevo archivo adjunto <?php echo $i ?>:</td>
                    <td   style='white-space: nowrap'>
                        <input type="file" name="file_<?php echo $i ?>" class="pm_text_field file_input" size="50"/>
                        &nbsp;<?php echo $max_upload_filesize ?> MB max per file
                    </td>
                </tr>
                <?php
            }
            ?>

        </table>








        <table>
            <tr>
                <td class="text_label_project"><div id="current_filesizes" style="padding-left: 10px; padding-right: 10px">0MB</div></td>
                <td colspan="3" class="text_label_project"><?php echo "Max. Total File Sizes = " . $max_total_send_filesize_mb ?> MB</td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td>
                    <input type="button" name="" id="add_file" value="+" style="float: right; cursor:pointer;"/>
                </td>
                <td style="width: 350px"></td>

            </tr>
        </table>




        <table style="width: 100%">

            <tr>
                <td colspan="3">
                    <table>
                        <?php
                        if (isset($comment['id_object'])) {
                            for ($i = 0; $i < count($list_attachment_files); $i++) {
                                $url_file = site_url($this->config->item("uri_comment_files") . "/" . $comment['id_object'] . "/" . get_filename_uploaded($list_attachment_files[$i]['name']));
                                ?>
                                <tr id="row_id_<?php echo $i ?>">
                                    <td class="text_label_project"><?php echo $view_labels['new_attachment_file'] ?> <?php echo ($i + 1) ?>:</td>
                                    <td class="pm_container_file_uploaded pm_width_text_field">
                                        <a href="<?php echo $url_file ?>"  rel="lightbox[roadtrip]"><?php echo $list_attachment_files[$i]['name'] ?>
                                            <img class="file_attachment_image"
                                                 title=""
                                                 alt=""
                                                 src="<?php echo $url_timthumb . "?src=" . $url_file . "&w=100&h=100"; ?>"/>
                                        </a>
                                        &nbsp;&nbsp;
                                        <div class="enqueue_by_left">
                                            <input type="checkbox" class="delete_file" id="<?php echo $i ?>" name="ids_delete_object[]" value="<?php echo $list_attachment_files[$i]['id_object'] ?>"/>
                                            <?php echo $view_labels['move_to_trash'] ?>
                                        </div>
                                        <input type="hidden" name="names_delete_object[]" value="<?php echo $list_attachment_files[$i]['name'] ?>"/>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </td>
            </tr>

        </table>


        <table style="width: 100%">
            <tr>
                <td colspan="3">
                    <?php
                    if (isset($comment['id_object'])) {
                        ?>
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id_object'] ?>"/>
                        <?php
                    }

                    if (!isset($comment)) {
                        ?>
                        <input type="hidden" name="add" value="ok"/>
                        <?php
                    }
                    if (isset($parent_comment_id)) {
                        ?>
                        <input type="hidden" name="parent_comment_id" value="<?php echo $parent_comment_id ?>"/>
                        <?php
                    }
                    if (isset($is_discussion)) {
                        ?>
                        <input type="hidden" name="is_discussion" value="<?php echo $is_discussion ?>"/>
                        <?php
                    }
                    ?>
                    <input type="submit" name="btn_save" value="Guardar"/>
                    <input type="submit" name="delete" value="Mover a la papelera"/>
                    <input type="reset" name="cancel" value="Cancelar"/>
                </td>
            </tr>
        </table>







        <?php
        echo form_close();
        ?>
        <div class="table-responsive">
            <div class="panel-default">
                <div class="panel-heading">
                    <h4>
                        LISTA DE MANTENIMIENTOS
                    </h4>
                </div>
            </div>
            <table class="table table-striped table-hover">

                <tr>
                    <th width="3%"  style="text-align: center; font-weight: bold;">#</th>
                    <th width="3%"  style="text-align: center; font-weight: bold;">ID MAINTENANCE</th>
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
                        <td><?php echo $list_maintenances[$i]['id_maintenance'] ?></td>
                        <td><?php echo $list_maintenances[$i]['maintenance_description'] ?>

                            <?php
                            $list_attachment_files = $list_maintenances[$i]['list_attachment_files'];
                            if (isset($list_attachment_files) AND count($list_attachment_files) > 0) {
                                ?>
                                <h2 style="padding-top:15px;">Adjuntos</h2>
                                <div class="files_attachments">
                                    <?php
                                    for ($j = 0; $j < count($list_attachment_files); $j++) {
                                        $uri_file = "./" . $this->config->item("uri_comment_files") . "/" . $list_maintenances[$i]['id_maintenance'] . "/" . get_filename_uploaded($list_attachment_files[$j]['post_title']);
                                        $url_file = site_url($uri_file);
                                        $file_size = "";
                                        if (file_exists($uri_file)) {
                                            $file_size = filesize($uri_file);
                                            ?>
                                            <div class="file_attachment">
                                                <div class="file_attachment_container_image">
                                                    <?php
                                                    if (getimagesize($uri_file)) {
                                                        ?>
                                                        <a href="<?php echo $url_file ?>" rel="lightbox[roadtrip]">
                                                            <img class="file_attachment_image"
                                                                 title=""
                                                                 alt=""
                                                                 src="<?php echo $url_timthumb . "?src=" . $url_file . "&w=100&h=100"; ?>">
                                                        </a>
                                                    <?php }
                                                    ?>
                                                </div>
                                                <div class="file_attachment_name">
                                                    <a href="<?php echo $url_file ?>"  target="_blank">
                                                        <?php echo $list_attachment_files[$j]['post_title'] ?>
                                                    </a>
                                                </div>
                                                <div class="file_attachment_size">
                                                    <?php echo human_filesize($file_size); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>

                        </td>
                        <td><?php echo $list_maintenances[$i]['maintenance_register_date'] ?></td>
                        <td><?php echo $list_maintenances[$i]['location_name'] ?></td>
                        <td>
                            <?php //print_r($list_maintenances[$i]['list_kardexes'])   ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th width="75">ID KARDEX STATUS</th>
                                        <th width="75">Tipo</th>
                                        <th width="75">Marca</th>
                                        <th width="75">Modelo</th>
                                        <th width="75">Codigo</th>
                                        <th width="75">Estado</th>
                                        <th width="75">Localidad</th>
                                        <th width="75">Ultimo cambio en</th>

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
                                            <td><?php echo $list_maintenances_kardexes[$k]['kardex_status_value'] ?></td>
                                            <td><?php echo $list_maintenances_kardexes[$k]['location_name'] ?></td>
                                            <td><?php echo $list_maintenances_kardexes[$k]['kardex_status_register_date'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>


                                </table>
                            </div>


                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

    </div>
</div>
