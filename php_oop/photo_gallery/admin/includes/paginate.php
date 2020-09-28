<?php

class Paginate {
    public $current_page;
    public $items_per_page;
    public $total_items;

    public function __construct($page = 1, $items_per_page = 4, $total_items = 0){
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        $this->total_items = (int)$total_items;
    }

    public function next() {
        return $this->current_page + 1;
    }

    public function previous () {
        return $this->current_page - 1; 
    }
    
    public function page_total(){
        return ceil($this->total_items / $this->items_per_page);
    }
}