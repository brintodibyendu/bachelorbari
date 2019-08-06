@extends('layouts.app')

      <!-- Main jumbotron for a primary marketing message or call to action -->
      @section('content')

<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">WELCOME!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="/advancesearch" method="get">
      <div class="modal-body mx-3">
        <div class="md-form mb-3">
          <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" name="namesearch" class="form-control">
            <label data-error="wrong" data-success="right" for="form34">Apartment name</label>
        </div>

        <div class="md-form mb-3">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="areasearch" name="areasearch" class="form-control">
          <label data-error="wrong" data-success="right" for="form29">Area</label>
        </div>

         <div class="md-form mb-3">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="pricesearch" name="pricesearch" class="form-control">
          <label data-error="wrong" data-success="right" for="form29">Price Range</label>
        </div>
         <div class="md-form mb-3">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="peoplesearch" name="peoplesearch" class="form-control">
          <label data-error="wrong" data-success="right" for="form29">No of People</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Search Apatment</button>
      </div>
       </form>
    </div>
  </div>
</div>

<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">SEARCH FOR APARTMENT</a></h1>
</div>
 @endsection