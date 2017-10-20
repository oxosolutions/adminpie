<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if($exception instanceof \Illuminate\Database\QueryException){
            if($exception->errorInfo[0] == '42S02'){
                $this->createTableIfNotExists($exception->errorInfo);
                return redirect()->route(request()->route()->action['as']);
            }
        }
        if ($exception instanceof TokenMismatchException){
            // Redirect to a form. Here is an example of how I handle mine
            return redirect($request->fullUrl())->with('csrf_error',"Oops! Seems you couldn't submit form for a long time. Please try again.");
        }
        // dump($exception->getFile());
        // dump($request);
        //if(env('APP_DEBUG')){
           // return parent::render($request, $exception);
        //}else{
            
            if($exception instanceof \Illuminate\Validation\ValidationException || $exception instanceof MethodNotAllowedHttpException){
                return parent::render($request, $exception);
            }else{
                return response()->view('errors.error-page',['exception'=>$exception,'request'=>$request],500);
                
            }
        //}
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    protected function createTableIfNotExists($errorDetails){
        $tableDetails = $errorDetails[2];
        $tableExploded = explode("'",$tableDetails);
        $tableString = explode('.',$tableExploded[1]);
        $tableToCreate = $tableString[1];
        $tableFromCreate = preg_replace('/[0-9]+/', '175', $tableToCreate);
        $describeTable = DB::select('DESCRIBE '.$tableFromCreate);
        $columnsArray = [];
        foreach($describeTable as $key => $columns){
            $columnsArray[] = $columns->Field.' '.$columns->Type.' '.(($columns->Null == 'NO')?'NOT NULL ':'').(($columns->Key == 'PRI')?'PRIMARY KEY ':'').(($columns->Extra != null)?$columns->Extra:'');
        }
        try{
            DB::statement('CREATE TABLE IF NOT EXISTS '.$tableToCreate.'('.implode(',',$columnsArray).')');
        }catch(\Exception $e){
            return false;
        }
        //DB::statement('CREATE TABLE IF NOT EXISTS '.$tableToCreate.' AS SELECT * FROM '.$tableFromCreate);
        //DB::statement('TRUNCATE '.$tableToCreate);
    }

    
}
