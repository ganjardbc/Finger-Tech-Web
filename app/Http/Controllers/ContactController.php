<?php

namespace Adventrest\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use Adventrest\ContactModel;
use Adventrest\ServiceModel;

class ContactController extends Controller
{
    //private
    function index()
    {
        $contact = ContactModel::AllContact(10, 'desc');
        return view('admin.contact.index', [
            'path' => 'contact',
            'contact' => $contact
        ]);
    }
    function create()
    {
        $service = ServiceModel::All();
        return view('admin.contact.create', [
            'path' => 'contact',
            'service' => $service
        ]);
    }
    function edit($idcontact)
    {
        $contact = ContactModel::ContactById($idcontact);
        $service = ServiceModel::All();
        return view('admin.contact.edit', [
            'path' => 'contact',
            'contact' => $contact,
            'service' => $service
        ]);
    }

    //post
    function publish(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $service = $req['service'];
            $name = $req['name'];
            $email = $req['email'];
            $phone = $req['phone'];
            $budget = $req['budget'];
            $message = $req['message'];
            $status = $req['status'] ? 1 : 0;

            $data = [
                'service' => $service,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'budget' => $budget,
                'budget' => $budget,
                'message' => $message,
                'status' => $status,
            ];

            $sql = ContactModel::Insert($data);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Upload contact success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Upload contact failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }

    }

    function put(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idcontact = $req['idcontact'];
            $service = $req['service'];
            $name = $req['name'];
            $email = $req['email'];
            $phone = $req['phone'];
            $budget = $req['budget'];
            $message = $req['message'];
            $status = $req['status'] ? 1 : 0;

            $data = [
                'service' => $service,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'budget' => $budget,
                'budget' => $budget,
                'message' => $message,
                'status' => $status,
            ];

            $sql = ContactModel::Edit($data, $idcontact);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited contact success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Edited contact failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }

    }

    function remove(Request $req)
    {
        $id = Auth::id();
        if (!empty($id)) 
        {
            $idcontact = $req['idcontact'];

            //remove database
            $sql = ContactModel::Remove($idcontact);
            if ($sql) 
            {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Delete contact success',
                ]);
            } 
            else 
            {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Delete contact failed',
                ]);
            }
        } 
        else 
        {
            return json_encode([
                'status' => 'error',
                'message' => 'Access denied',
            ]);
        }
    }
}
