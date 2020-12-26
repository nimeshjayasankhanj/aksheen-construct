<div class="modal fade" id="addCategoryModal" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data"
                action="{{ route('saveCategory') }}" id="saveCategoryId">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Category<span style="color: red"> *</span></label>

                    <input type="text" class="form-control" name="categry" id="categry"
                           placeholder="Category"/>
                    <span class="text-danger" id="categryError"></small>
                </div>

                <button type="submit" class="btn btn-md btn-outline-primary waves-effect "
                        style="border-radius: 24px">
                    Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>



