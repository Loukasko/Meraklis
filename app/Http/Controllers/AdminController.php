<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Lawbreaker;
use App\Manager;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function payroll(Request $request){
        $managers=Manager::all();
        $lawbreakers=Lawbreaker::all();

        $month=Input::get('selectMonth');
        $year=Input::get('selectYear');

        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        // Start a new document
        $xml->startDocument();
        $xml->startElement('xml');
        // Start a element to put data in
        $xml->startElement('header');
            $xml->startElement('transaction');
                $xml->startElement('period');
                $xml->writeAttribute("month",$month);
                $xml->writeAttribute('year',$year);
                $xml->endElement();
            $xml->endElement();
        $xml->endElement();
        $xml->startElement('body');

        $xml->startElement('employees');
        // Data what goes in your element\
        foreach($managers as $manager){
            $xml->startElement('employee');
            $xml->writeElement("firstName", $manager->name);
            $xml->writeElement("lastName", $manager->surname);
            $xml->writeElement("amka", $manager->AMKA);
            $xml->writeElement("afm", $manager->AFM);
            $xml->writeElement("iban", $manager->IBAN);
            $xml->writeElement("ammount", $manager->salary);
            $xml->endElement();
        }
        foreach($lawbreakers as $lawbreaker){
            $xml->startElement('employee');
            $xml->writeElement("firstName", $lawbreaker->name);
            $xml->writeElement("lastName", $lawbreaker->surname);
            $xml->writeElement("amka", $lawbreaker->AMKA);
            $xml->writeElement("afm", $lawbreaker->AFM);
            $xml->writeElement("iban", $lawbreaker->IBAN);
            $xml->writeElement("ammount", $lawbreaker->salary);
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endElement();
        $xml->endElement();
        $xml->endDocument();

        // You put the XML content in this variable
        $contents = $xml->outputMemory();
        // Reset XML just in case
        $xml = null;

        Storage::put('payroll.xml',$contents);
        return Storage::download('payroll.xml');

    }

}
