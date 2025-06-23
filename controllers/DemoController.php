<?php
class DemoController extends Controller
{
    protected static DemoController $instance;
    public function index()
    {
        echo "This is Index From Demo";
    }
}