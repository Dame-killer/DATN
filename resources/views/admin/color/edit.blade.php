<!-- Add Author Modal -->
<div class="modal fade" id="editColorModal" tabindex="-1" aria-labelledby="editColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editColorModalLabel">Sửa màu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="authorName" class="form-label">STT</label>
                        <input type="text" class="form-control" id="authorName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="authorEmail" class="form-label">Tên</label>
                        <input type="email" class="form-control" id="authorEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="authorStatus" class="form-label">Status</label>
                        <select class="form-control" id="authorStatus" name="status" required>
                            <option value="online">Sử dụng</option>
                            <option value="offline">Không sử dụng</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
