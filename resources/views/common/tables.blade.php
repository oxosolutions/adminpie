@extends('layouts.front')
@section('content')
<style type="text/css">
	   table  td , th{
	            border:1px solid lightgray;
	    }

	    #table-structure{
	    	max-width: 1080px;
	    	overflow: scroll;
	    	font-weight: 300;

	    }
	    #table-structure tr {
	    transition: background 0.2s ease-in;
	}

	#table-structure tr:nth-child(odd) {
	    background: #CCE5A3;
	    /*background: #FF9A00;*/
	}

	#table-structure tr:hover {
	    background: #8bc34a;
	    cursor: pointer;
	}

</style>
	  <table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th>Item Price</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
          </tr>
        </tbody>
      </table>	
				
@endsection
