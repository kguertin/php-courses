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
}