<div class="modal fade" id="addProductModal" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data"
                action="{{ route('saveProduct') }}" id="saveProductId">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Brand<span style="color: red"> *</span></label>

                            <select class="form-control select2 tab" name="category"
                                        id="category" >
                                    <option value="" disabled selected>Select Brand
                                    </option>
                                    @if(isset($brands))
                                        @foreach($brands as $brand)
                                            <option value="{{"$brand->idcategory"}}">{{$brand->category_name}} </option>
                                        @endforeach
                                    @endif

                                </select>
                            <span class="text-danger" id="categryError"></small>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Product Name<span style="color: red"> *</span></label>

                            <input type="text" class="form-control" name="pName" id="pName" autocomplete="off"
                                   placeholder="Product Name"/>
                            <span class="text-danger" id="pNameError"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                            <div class="form-group">
                                <label>Cost Price<span style="color: red"> *</span></label>

                                <input type="text" class="form-control" name="cPrice" id="cPrice" autocomplete="off"
                                       placeholder="0.00"/>
                                <span class="text-danger" id="cPriceError"></small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Selling Price<span style="color: red"> *</span></label>

                            <input type="text" class="form-control" name="sPrice" id="sPrice" autocomplete="off"
                                   placeholder="0.00"/>
                            <span class="text-danger" id="sPriceError"></small>
                    </div>
                </div>


                </div>

                <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="saveProduct"
                        style="border-radius: 24px">
                    Save Product</button>

                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                    style="border-radius: 24px;display: none">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                </form>
            </div>
        </div>
    </div>
</div>



