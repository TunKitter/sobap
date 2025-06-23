<?php
class HackingController extends Controller
{
    protected static HackingController $instance;
    public function index()
    {
        echo "This is Index from Hacking";
    }
    public function vainoi()
    {
        echo "Vai noi that";
    }
}