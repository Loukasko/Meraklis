<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Store;
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

    public function getPayroll()
    {
        return view('admin.newPayroll');
    }

    public function getNewStore()
    {
        $managers=Manager::all();
        //$stores=Store::all();
        //$data=array('orders'=>$orders,'stores'=>$stores);
        $data=array('managers'=>$managers);
        return view('admin.newStore')->with($data);
    }

    public function newStore(){
        $store=new Store();
        $store->name=Input::get('storeName');
        $store->phone=Input::get('storePhone');
        $store->address=Input::get('storeAddress');
        $store->loc_lat=Input::get('storeLat');
        $store->loc_long=Input::get('storeLng');
        $store->chainId=1;

        if( Input::get('checkChoose')=='on') {
            $aa= Input::get('chooseManager');
            $name=strtok($aa," ");
            $aa=strtok(" ");
            $surname=strtok($aa," ");
            $manId=Manager::where('name',$name)->where('surname',$surname);
            $store->managerId=$manId;
        }

        else{
            $manager=new Manager();
            $manager->username=Input::get('managerUsername');
            $manager->password=bcrypt(Input::get('managerPassword'));
            $manager->name=Input::get('managerName');
            $manager->surname=Input::get('managerLastName');
            $manager->AFM=Input::get('managerAfm');
            $manager->AMKA=Input::get('managerAmka');
            $manager->IBAN=Input::get('managerIban');
            $manager->created_at=now();
            $manager->updated_at=now();

            $manager->save();
            //echo $manager->id;
            $store->managerId=$manager->id;
        }

        $store->save();
        return view('admin.home')->with('msg','Εγινε επιτυχής εκχώρηση Καταστήματος');

    }

    public function payroll(){
        $managers=Manager::all();
        $lawbreakers=Lawbreaker::all();

        $month=Input::get('selectMonth');
        $year=Input::get('selectYear');

        $xml = new \XMLWriter();
        $xml->openMemory();

        //gia na ta deixnei kala se apla arxeia
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
