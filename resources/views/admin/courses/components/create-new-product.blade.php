<div class="modal fade" id="new-product-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="product-label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-label">Create New Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="new-product-form">
          <div class="mb-2 d-flex flex-column">
            <label class="form-label" for="status">Select Product Category:</label>
            <select name="category" class="form-control"></select>
          </div>
          <div class="mb-2">
            <label class="form-label" for="status">Enter Product Name:</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Product Name">
          </div>
          <div class="mb-2">
            <label class="form-label" for="status">Enter Description Name:</label>
            <input type="text" name="description" class="form-control" placeholder="Enter Product Description">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="create-new-product">Create</button>
      </div>
    </div>
  </div>
</div>