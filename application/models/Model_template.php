<?php

class Model_Template extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->query("SET SESSION time_zone='-4:00'");
    }

    #############################################################################

    function add_post($data) {
        $this->db->set("post_register_date", "NOW()", FALSE);
        $this->db->set("post_status_date", "NOW()", FALSE);
        $this->db->insert("posts", $data);

        return $this->db->insert_id();
    }

    #############################################################################

    function get_id_selectable_by($selectable_column_name, $selectable_value, $selectable_sub_group = null) {


        $this->db->select("
                 id_selectable,
                 selectable_value,
                 selectable_column_name,
                 selectable_order_by");

        $this->db->from("selectables");
        $this->db->where("LOWER(selectable_column_name)", strtolower($selectable_column_name));
        $this->db->where("LOWER(selectable_value)", strtolower($selectable_value));

        if (isset($selectable_sub_group) AND strcasecmp($selectable_sub_group, "") != 0) {
            $this->db->where("LOWER(selectable_sub_group)", strtolower($selectable_sub_group));
        }
        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['id_selectable'];
    }

    #############################################################################
    /* last row will have   order=null */

    function add_user_post($data, $action_status = "created", $action_status_sub_group = null) {
        #-------------------------------------------------------------------------
        $this->db->cache_on();
        $object_id = $data['post_id'];
        $user_role_id = $data['user_role_id'];

        $sql = "SELECT id_user_post
            FROM user_posts
            WHERE post_id=" . $object_id . "
              AND `user_post_sorter` IS NULL";
        $last_query = $this->db->query($sql);
        $last_user_post = $last_query->row_array();
        $this->db->cache_off();
        if (!empty($last_user_post) AND isset($last_user_post['id_user_post'])) {
            $id_last_user_post = $last_user_post['id_user_post'];

            $this->db->cache_on();
            $sql = "SELECT COUNT(*) AS quantity
               FROM user_posts
               WHERE post_id=" . $object_id;
            $count_query = $this->db->query($sql);
            $row_count_user_post = $count_query->row_array();
            $this->db->cache_off();
            if (!empty($row_count_user_post) AND isset($row_count_user_post['quantity'])) {
                $count_user_post = $row_count_user_post['quantity'];
                $this->db->cache_on();
                $data_update = array("user_post_sorter" => $count_user_post);
                $conditions = array("id_user_post" => $id_last_user_post);
                $this->db->update("user_posts", $data_update, $conditions);
                $this->db->cache_off();
            }
        }
        #-------------------------------------------------------------------------


        $action_status_select_id = $this->get_id_selectable_by("user_post_action_status", $action_status, $action_status_sub_group);
        $this->db->cache_on();
        $data["user_post_sorter"] = null;
        $data["action_status_select_id"] = $action_status_select_id;
        $data["user_post_register_date"] = $this->get_system_time();
        $this->db->insert("user_posts", $data);

        $this->db->cache_off();
    }

    #############################################################################

    function get_list_attachment_files($parent_id) {
        $action_status_select_id = $this->get_id_selectable_by("user_post_action_status", "moved_to_trash");
        $type_select_id = $this->get_id_selectable_by("post_type", "file");

        $this->db->select('posts.id_post,
                posts.project_id,
                posts.parent_id,
                posts.user_id,
                posts.company_id,
                posts.post_title,
                posts.post_register_date,
                posts.post_content');

        $this->db->from('posts');
        $this->db->join('user_posts', "user_posts.post_id=posts.id_post");
        $this->db->where('posts.parent_id', $parent_id);

        $this->db->where('post_type_selectable_id', $type_select_id);

        $this->db->where('user_post_sorter', NULL, FALSE);
        $this->db->where('user_posts.action_status_select_id!=', $action_status_select_id, FALSE);
        $this->db->order_by('post_register_date DESC');
        $query = $this->db->get();


        return $query->result_array();
    }

    ###############################################################

    function generate_list_locations_tree(&$list_tree, $parent_id = null, $level = 0) {
        $this->db->select("*");
        $this->db->from("locations");
        $this->db->where("parent_id", $parent_id);
        $query = $this->db->get();

        $list_result = $query->result_array();

        if (count($list_result) > 0) {
            for ($i = 0; $i < count($list_result); $i++) {
                $row = $list_result[$i];
                $row['level'] = $level;
                $list_tree[] = $row;

                $this->generate_list_locations_tree($list_tree, $list_result[$i]['id_location'], $level + 1);
            }
        }
    }

    #######################################################

    function get_list_locations() {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->order_by('location_name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    #############################################################################

    function add_time_default_to_user($user_id) {
        $ts_before_20_years = strtotime("1987-07-07");

        $data = array(
            "user_id" => $user_id,
            "time_in" => date("Y-m-d H:i:s", $ts_before_20_years),
            "time_out" => date("Y-m-d H:i:s", $ts_before_20_years + 1),
            "status_in" => "Valid",
            "status_out" => "Valid",
        );

        $this->db->insert("times", $data);
    }

    #############################################################################

    function get_row_time_last_by_user($user_id) {
        $sql_last = "SELECT ti.*
                 FROM times ti, users us
                 WHERE us.id='" . $user_id . "'
                   AND ti.user_id=us.id
                 ORDER BY ti.time_in DESC,
                          ti.time_out ASC
                 LIMIT 1;";
        $query = $this->db->query($sql_last);

        return $query->row_array();
    }

    #############################################################################

    function get_list_present_users_by($company_id, $dt_range_begin, $dt_range_end) {
        $sql = "SELECT up.user_id,
                   up.name,
                   up.last_name,
                   us.email,
                   us.username,
                   ti.max_time_in,
                   ti.num_corrections,
                   ro.name AS role,
                   IF( (up.user_id,ti.max_time_in)  IN (SELECT user_id, time_in
                                                        FROM times
                                                        WHERE time_in IS NOT NULL AND status_out IS NULL
                                                          AND CAST(time_in AS DATETIME) BETWEEN CAST('" . $dt_range_begin . "' AS DATETIME)
                                                                                                 AND
                                                                                                 CAST('" . $dt_range_end . "' AS DATETIME)

                                                        )
                   ,1
                   ,0
                   ) AS is_present

            FROM user_profiles up,
                 users us,
                 user_roles ur,
                 roles ro,
                 (
                 SELECT ti.user_id, max(ti.time_in) AS max_time_in,
                        (sum(IF(lower(ti.status_in)='corrected', 1, 0)) + sum(IF(lower(ti.status_out)='corrected', 1, 0))) AS num_corrections
                 FROM times ti
                 GROUP BY ti.user_id
                 ) AS ti

            WHERE ti.user_id = us.id
              AND us.company_id='" . $company_id . "'
              AND us.id = up.user_id
              AND up.user_id=ur.user_id
              AND ur.role_id = ro.id
              AND LOWER(ur.status) = 'active'
            ORDER BY ro.id;";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * @param        $user_id Is id_time from TABLE times, to filter user x data only
     *                                     their values ​​should be [INTEGER]
     *
     * @param        $date_begin Is begin Date begin
     *                           their values ​​should be [DATE_TIME or DATE '2011-03-25']
     * @param        $date_end   Is begin Date end
     *                           their values ​​should be [DATE_TIME or DATE  '2011-04-02']
     *
     *                  May contain for weeks, months, years or any other valid range
     *
     *
     * @return        array(
     *                      'id_time'=>[INTEGER],
     *                      'time_in'=>[DATE_TIME],
     *                      'time_out'=>[DATE_TIME],
     *                      'status_in'=>=>['valid' |  'observed' | 'corrected'],
     *                      'status_out'=>=>['valid' |  'observed' | 'corrected'],
     *                      'sub_total'=>[FLOAT {hours}]
     *                      );
     *
     *                the array will only have ONE OR MORE rows depending on the condition
     */
    function get_list_times($dt_begin, $dt_end, $user_id = null, $company_id = null, $limit_records = 0) {
        $sql_limit = "";

        if ($limit_records > 0) {
            $sql_limit = " LIMIT " . $limit_records;
        }

        $sql_user_id = "";


        if (isset($user_id)) {
            $sql_user_id = " AND ti.user_id='" . $user_id . "'";
        }
        $sql_FROM_company = "";
        $sql_WHERE_company = "";

        if (isset($company_id)) {
            $sql_FROM_company = ", users us, companies co";
            $sql_WHERE_company = " AND co.id=us.company_id AND us.id=ti.user_id AND co.id='" . $company_id . "'";
        }

        $sql = "
            SELECT ti.id_time,
                   ti.time_in,
                   ti.time_out,
                   ti.status_in,
                   ti.status_out,
                   ti.user_id,
                   WEEKOFYEAR(ti.time_in) AS week_of_year,

                   ABS(TIMESTAMPDIFF(SECOND, ti.time_out, ti.time_in)/ 3600 ) AS sub_total
            FROM times ti
                " . $sql_FROM_company . "
            WHERE (
                     (
                      ti.time_in BETWEEN CAST('" . $dt_begin . "' AS DATETIME) AND CAST('" . $dt_end . "' AS DATETIME)
                     )
                     OR
                     (
                      ti.time_out BETWEEN CAST('" . $dt_begin . "' AS DATETIME) AND CAST('" . $dt_end . "' AS DATETIME)
                     )
                   )
                   " . $sql_user_id . "
                   " . $sql_WHERE_company . "
            ORDER BY ti.user_id ASC, ti.time_in ASC, ti.time_out ASC " . $sql_limit . ";";

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    #######################################################

    function get_list_table_column_search($table, $column_name, $search_value) {
        $sql = "SELECT DISTINCT " . $column_name . " FROM " . $table . " WHERE " . $column_name . " LIKE '%" . $search_value . "%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    #############################################################################

    function get_list_table_enum_column_values($table, $column) {
        $query = $this->db->query("show columns from " . $table . " LIKE '" . $column . "';");
        $row = $query->row_array();
        $array_values = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type']) - 6))));

        return $array_values;
    }

    #############################################################################

    function get_system_time() {
        $query = $this->db->query("SELECT now() AS date_ts_now;");
        $date_now = $query->row_array();

        return $date_now['date_ts_now'];
    }

    #############################################################################

    function get_selectable_by($id_selectable) {
        $this->db->select("
                 *");

        $this->db->from("selectables");
        $this->db->where("id_selectable", $id_selectable);

        $this->db->limit(1);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    #############################################################################

    function get_list_selectable_by($selectable_column_name, $selectable_value = null, $selectable_sub_group = null, $minus_array_values = array()) {
        $this->db->select("
                 id_selectable,
                 selectable_value,
                 selectable_columna_name,
                 selectable_order_by");

        $this->db->from("selectables");

        $this->db->where("LOWER(selectable_column_name)", strtolower($selectable_column_name));

        if (isset($selectable_value)) {
            $this->db->where("LOWER(selectable_value)", strtolower($selectable_value));
        }

        if (isset($selectable_sub_group)) {
            $this->db->where("LOWER(selectable_sub_group)", strtolower($selectable_sub_group));
        }

        if (!empty($minus_array_values)) {
            for ($i = 0; $i < count($minus_array_values); $i++) {
                $this->db->where("LOWER(selectable_value)!=", "'" . strtolower($minus_array_values[$i]) . "'", FALSE);
            }
        }

        $this->db->order_by("selectable_order_by");

        $query = $this->db->get();
        return $query->result_array();
    }

}
