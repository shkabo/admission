<?php

namespace App\Http\Controllers;

use App\AdmissionTypes;
use Illuminate\Http\Request;

class Admissions extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = \Auth::user()->role;
        switch($role->name) {
            case 'administrator':
                return 'admin';
                break;
            case 'staff':
                return $this->staffApplicationsListing();
                break;
            default:
                // return only available opened application types where student didn't apply
                $current_applications = \App\Admissions::where('user_id', \Auth::user()->id)->pluck('admission_types_id')->toArray();
                $available_types = AdmissionTypes::where('status', 1)->whereNotIn('id', $current_applications)->paginate(15);
                return view('admission.student', ['types' => $available_types]);
                break;
        }
    }

    /**
     * handle ajax request for available time
     *
     * @param $date
     * @return string
     */
    public function ajaxTime($id, $date) {
        // time passed form ajax call
        $datetime = \Carbon\Carbon::parse($date);
        // get array of ID's that are being used currently in the database
        $admissions = \App\Admissions::where('date', $datetime)->where('admission_types_id', $id)->pluck('working_hours_id')->toArray();

        // get available id's and times for students to apply
        $intervals = \DB::table('working_hours')->whereNotIn('id', $admissions)->get();
        return json_encode(['datum' => $intervals]);
    }

    /**
     *  Store students applications in the db
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request, $id) {
        if (!$request->has(['datum', 'vreme'])) {
            abort(400, 'There was something wrong with the request');
        }
        $data = [
            'user_id' => \Auth::user()->id,
            'admission_types_id' => $id,
            'date' => \Carbon\Carbon::parse($request->datum),
            'working_hours_id' => $request->vreme,
        ];
        if(! \App\Admissions::create($data)->id) {
            return back()->with('error', 'Something went wrong while saving your application');
        }
        $type_name = \App\AdmissionTypes::find($id)->name;
        return redirect()->route('admission.show.list')->with('success', 'You have successfully applied to ' . $type_name);
    }

    /**
     *  List of students applications
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applicationsList() {
        if (! \Auth::user()->isStudent()) {
            abort(403, 'You can\'t access this area');
        }
        $applications = \DB::table('admissions as ad')
                            ->select('at.name', 'ad.date', 'wh.time', 'ad.status')
                            ->join('admission_types as at', 'ad.admission_types_id', 'at.id')
                            ->join('working_hours as wh', 'ad.working_hours_id', 'wh.id')
                            ->where('user_id', \Auth::user()->id)
                            ->paginate(15);
        return view('admission.applied', ['applications' => $applications]);
    }

    public function staffApplicationsListing() {
        if (! \Auth::user()->isStaff()) {
            abort(403, 'You can\'t access this area');
        }
        $applications = \DB::table('admissions as ad')
            ->select('ad.id', 'at.name', 'ad.date', 'wh.time', 'ad.status', 'u.name as user')
            ->join('admission_types as at', 'ad.admission_types_id', 'at.id')
            ->join('working_hours as wh', 'ad.working_hours_id', 'wh.id')
            ->join('users as u', 'ad.user_id', 'u.id')
            ->paginate(15);
        return view('admission.stafflist', ['applications' => $applications]);
    }
}
