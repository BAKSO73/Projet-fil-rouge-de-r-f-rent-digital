<?php
// Exit if called directly
if (!defined('ABSPATH')) {
    exit();
}

if (!class_exists('S9_Widget_List_Table')) {
    if (!class_exists('WP_List_Table')) {
        require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
    }
    class S9_Widget_List_Table extends WP_List_Table
    {
        function get_columns()
        {
            $columns = array(
                //'cb' => '<input type="checkbox" />',
                'title' => 'Tool',
                'widget' => 'Tool Type',
                'shortcode' => 'Shortcode',
                'active' => 'Active Status'
            );
            return $columns;
        }
        function column_cb($item)
        {
            return sprintf(
                '<input type="checkbox" name="share[]" value="%s" />',
                $item['ID']
            );
        }
        function prepare_items()
        {
            $s9sdk = new Social9();
            $s9Data = $s9sdk->getWidgetList(get_option('social9_account_id'));
            $example_data = [];
            if($s9Data){
            $i = 0;
            foreach ($s9Data as $widgetData) {
                if(isset($widgetData["id"])){
                    if(in_array($widgetData["widget_type"], array('inline','floating'))){
                    $example_data[$i]["ID"] = $widgetData["id"];
                    $example_data[$i]["title"] = $widgetData["name"];
                    $example_data[$i]["widget"] = ucfirst($widgetData["widget_type"]);
                    $example_data[$i]["shortcode"] = $widgetData["options"]["container"];
                    $example_data[$i]["active"] = $widgetData["is_active"] ? "Activated" : "Inactive";
                }
            }
                $i++;
            }}

            $columns = $this->get_columns();
            $hidden = array();
            $sortable = array();
            $this->_column_headers = array($columns, $hidden, $sortable);
            $per_page = $this->get_items_per_page('shares_per_page', 10);
            $current_page = $this->get_pagenum();
            $total_items = count($example_data);

            // only ncessary because we have sample data
            $this->items = array_slice($example_data, (($current_page - 1) * $per_page), $per_page);
            $this->set_pagination_args(array(
                'total_items' => $total_items, //WE have to calculate the total number of items
                'per_page' => $per_page //WE have to determine how many items to show on a page
            ));
        }

        function column_title($item)
        {
            $actions = array(
                'edit' => sprintf('<a href="?page=%s&action=%s&share=%s&type=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['ID'],strtolower($item['widget']))
            );
            if($item['active'] == "Inactive"){
                $actions['active'] = sprintf('<a href="#" data-action="active" data-id="'.$item['ID'].'" class="s9TriggerStatus" >Active</a>', $_REQUEST['page'], 'active', $item['ID'],strtolower($item['widget']));
            }else{
                $actions['deactive'] = sprintf('<a href="#" data-action="deactive" data-id="'.$item['ID'].'" class="s9TriggerStatus">Deactive</a>', $_REQUEST['page'], 'deactive', $item['ID'],strtolower($item['widget']));
            }

            return sprintf('<img src="'.S9_SHARE_PLUGIN_URL.'assets/images/'.strtolower($item['widget']).'.svg"/><div class="s9-widget-title">%1$s %2$s</div>', $item['title'], $this->row_actions($actions));
        }

        function column_shortcode($item)
        {
            if(strtolower($item["widget"]) == "inline"){
                $dataValue = substr($item['shortcode'],1);
                if(substr($item['shortcode'],0,1) == '.'){
                    $dataField = 'class';                    
                }else{
                    $dataField = 'id';
                }
                return sprintf('[Social9_Share '.$dataField.'="'.$dataValue.'"]');
            }
            return "None";
        }

        function column_default($item, $column_name)
        {
            switch ($column_name) {
                case 'title':
                case 'widget':
                case 'active':
                    return $item[$column_name];
                default:
                    return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
        }
        function no_items()
        {
            _e('No share widget found.');
        }
    }
}
