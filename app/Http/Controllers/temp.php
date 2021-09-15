<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

session_start();
class temp extends Controller
{
    function displayPrescription(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        echo $doc_id = $_SESSION['d_unid'];
        $result = true;
        $collection = $db->employee;
        $patinet_result = $collection->findOne(['p_unid' => strval($req->input('pat_id'))]);

        $collection = $db->manager;
        $doctor_result = $collection->findOne(['d_unid' => strval($doc_id)]);

        // return print_r($req->input());
        foreach($patinet_result['prescription'] as $doctor_id => $doc_id_obj) {
            if($doctor_id == $doc_id) {
                foreach($doc_id_obj as $date => $date_obj) {
                    foreach($date_obj as $prescription_id => $prescription_id_array) {
                        // $result = true;
                        echo '<tr class="py-5">
                                <td class="text-nowrap">'.date('d M Y', strtotime($date)).'</td>
                                <td class="text-f">'.$prescription_id.'</td>';
                            echo'<td class="d-flex">
                                    <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40">
                                    <div class="d-flex flex-column m-0 px-2">
                                        <p class="text-nowrap m-0">Dr. '.$doctor_result['fname'].' '.$doctor_result['sname'].'</p>
                                        <p class="text-muted m-0">Dental</p>
                                    </div>
                                </td>';
                            echo'<td>
                                    <div class="d-flex justify-content-between action">
                                        <button class="btn print btn-sm text-nowrap mx-1"><i class="bi bi-printer mx-1"></i>Print</button>
                                        <button class="btn view btn-sm text-nowrap mx-1"><i class="bi bi-eye-fill mx-1"></i>View</button>
                                        <button class="btn edit btn-sm text-nowrap mx-1"><i class="bi bi-pencil-fill mx-1"></i>Edit</button>
                                        <button class="btn delete btn-sm text-nowrap mx-1"><i class="bi bi-trash-fill mx-1"></i>Delete</button>
                                    </div>
                                </td>
                            </tr>';
                            
                    }
                }
            }
        }

        // if($result == false) {
        //     return 'false';
        // }

    }
}
