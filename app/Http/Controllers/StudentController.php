<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return view('index', compact('student'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $message = $request->input('message');

        $options = array(
            'location' => 'http://localhost:8080/Test/server.php',
            'uri' => 'http://example.com/soap'
        );

        $client = new \SoapClient(null, $options);
        $result = $client->displayString($message);
        return view('create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = $request->input('message');

        $options = array(
            'location' => 'http://localhost:8080/Test/server.php',
            'uri' => 'http://example.com/soap'
        );

        $client = new \SoapClient(null, $options);
        $result = $client->displayString($message);

        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $student = Student::create($storeData);
        return redirect('/students')->with('completed', 'Student has been saved!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // StudentController.php
     /**
     * Edit the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('edit', compact('student'));
    }
    /**
     * Update the specified resource in db.
     */
    public function update(Request $request, $id)
    {
        $message = $request->input('message');

        $options = array(
            'location' => 'http://localhost:8080/Test/server.php',
            'uri' => 'http://example.com/soap'
        );

        $client = new \SoapClient(null, $options);
        $result = $client->displayString($message);
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        Student::whereId($id)->update($updateData);
        return redirect('/students')->with('completed', 'Student has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $message = $request->input('message');

        $options = array(
            'location' => 'http://localhost:8080/Test/server.php',
            'uri' => 'http://example.com/soap'
        );

        $client = new \SoapClient(null, $options);
        $result = $client->displayString($message);
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('completed', 'Student has been deleted');
    }
    
}