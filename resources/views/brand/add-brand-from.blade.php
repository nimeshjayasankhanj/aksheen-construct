<div class="modal fade" id="addBrandModal" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Brand</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data"
                action="{{ route('saveBrand') }}" id="saveBrandId">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Brand<span style="color: red"> *</span></label>

                    <input type="text" class="form-control" name="category" id="category" autocomplete="off"
                           placeholder="Brand"/>
                    <span class="text-danger" id="categryError"></small>
                </div>

                <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="saveBrand"
                        style="border-radius: 24px">
                    Save Brand</button>

                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                    style="border-radius: 24px;display: none">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                </form>
            </div>
        </div>
    </div>
</div>



