<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\auth()->user()->is_librarian){
            $borrow=\App\Models\Borrow::all();
            $pbook=$borrow->where('status','===','PENDING');
            $abook=$borrow->where('status','===','ACCEPTED')->where('deadline','>',now());
            $lbook=$borrow->where('status','===','ACCEPTED')->where('deadline','<',now());
            $rbook=$borrow->where('status','===','REJECTED');
            $rtbook=$borrow->where('status','===','RETURNED');
            return view('borrows.index',[
                'pending'=>$pbook,
                'inTime'=>$abook,
                'late'=>$lbook,
                'rejected'=>$rbook,
                'returned'=>$rtbook,
            ]);
        }else{
        $borrow=\App\Models\Borrow::all()->where('reader_id','===',auth()->id());
        $pbook=$borrow->where('status','===','PENDING');
        $abook=$borrow->where('status','===','ACCEPTED')->where('deadline','>',now());
        $lbook=$borrow->where('status','===','ACCEPTED')->where('deadline','<',now());
        $rbook=$borrow->where('status','===','REJECTED');
        $rtbook=$borrow->where('status','===','RETURNED');
        return view('borrows.index',[
            'pending'=>$pbook,
            'inTime'=>$abook,
            'late'=>$lbook,
            'rejected'=>$rbook,
            'returned'=>$rtbook,
        ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBorrowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBorrowRequest $request)
    {
        $book=$request->all()['book'];
        $data = $request->validated();
        $data['reader_id'] = Auth::id();
        $data['book_id'] = $book;
        $data['status'] = 'PENDING';
        $data['request_process_at']=now();
        Borrow::create($data);

        return redirect()->route('books.show',['book'=>$book]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {

        return view('borrows.detail',[
           'borrow'=>$borrow
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBorrowRequest  $request
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBorrowRequest $request, Borrow $borrow)
    {
        $this->authorize('is_librarian');
        $borrow->update($request->validated());
        return redirect()->route('borrows.show',['borrow'=>$borrow]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}
