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

        if(!($store->name && $store->phone && $store->address && $store->loc_lat && $store->loc_long)){
            return redirect()->back()->with('msg','Δεν έχετε συμπληρώσει όλα τα στοιχεία της φόρμας καταχώρηση καταστήματος');
        }

        if( Input::get('checkChoose')=='on') {
            $aa= Input::get('chooseManager');
            $name=strtok($aa," ");
            $aa=strtok(" ");
            $surname=strtok($aa," ");
            if(!($name && $surname))return redirect()->back()->with('msg','Δεν επιλέξατε υπεύθυνο από τη φόρμα');
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
            if(!($manager->username && $manager->password && $manager->name && $manager->surname && $manager->AFM && $manager->AMKA && $manager->IBAN)){
                return redirect()->back()->with('msg','Δεν συμπληρώσει όλα τα στοιχεία της φόρμας καταχώρηση νέου υπεύθυνου');
            }
            $manager->created_at=now();
            $manager->updated_at=now();

            $manager->save();
            //echo $manager->id;
            $store->managerId=$manager->id;
        }

        $store->save();
        return view('admin.home')->with('msg','Εγινε επιτυχής εκχώρηση Καταστήματος');

    }

    public function getNewManager()
    {
        return view('admin.newManager');
    }

    public function newManager(){
            $manager=new Manager();
            $manager->username=Input::get('managerUsername');
            $manager->password=bcrypt(Input::get('managerPassword'));
            $manager->name=Input::get('managerName');
            $manager->surname=Input::get('managerLastName');
            $manager->AFM=Input::get('managerAfm');
            $manager->AMKA=Input::get('managerAmka');
            $manager->IBAN=Input::get('managerIban');
            if(!($manager->username && $manager->password && $manager->name && $manager->surname && $manager->AFM && $manager->AMKA && $manager->IBAN)){
                return redirect()->back()->with('msg','Δεν συμπληρώσει όλα τα στοιχεία της φόρμας καταχώρηση νέου υπεύθυνου');
            }
            $manager->created_at=now();
            $manager->updated_at=now();

            $manager->save();
            //echo $manager->id;

        return view('admin.home')->with('msg','Εγινε επιτυχής εκχώρηση Υπεύθυνου');

    }

    public function getNewLawbreaker()
    {
        return view('admin.newLawbreaker');
    }

    public function newLawbreaker(){
        $lawbreaker=new Lawbreaker();
        $lawbreaker->username=Input::get('lawbreakerUsername');
        $lawbreaker->password=bcrypt(Input::get('lawbreakerPassword'));
        $lawbreaker->name=Input::get('lawbreakerName');
        $lawbreaker->surname=Input::get('lawbreakerLastName');
        $lawbreaker->AFM=Input::get('lawbreakerAfm');
        $lawbreaker->AMKA=Input::get('lawbreakerAmka');
        $lawbreaker->IBAN=Input::get('lawbreakerIban');
        if(!($lawbreaker->username && $lawbreaker->password && $lawbreaker->name && $lawbreaker->surname && $lawbreaker->AFM && $lawbreaker->AMKA && $lawbreaker->IBAN)){
            return redirect()->back()->with('msg','Δεν συμπληρώσει όλα τα στοιχεία της φόρμας καταχώρηση νέου υπεύθυνου');
        }
        $lawbreaker->status=0;
        $lawbreaker->loc_lat=38.246639;
        $lawbreaker->loc_long=21.734573;
        $lawbreaker->chainId=1;

        $lawbreaker->created_at=now();
        $lawbreaker->updated_at=now();

        $lawbreaker->save();
        //echo $manager->id;

        return view('admin.home')->with('msg','Εγινε επιτυχής εκχώρηση Παραβάτη');

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
