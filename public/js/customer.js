$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    window.removeRow = function(id,url){
        if(confirm('Bạn có chắc chắn muốn xóa không. Khi xóa sẽ không tái sử dụng được nữa !')){
            $.ajax({
                type: 'DELETE', 
                datatype: 'JSON',
                data: {
                    id: id,  // Gửi ID cùng với yêu cầu
                    _token: $('meta[name="csrf-token"]').attr('content') // Gửi CSRF token
                },
                url: url,
                success: function(result){
                    if(result.error == false){
                        alert(result.message);
                        location.reload();
                    }else{
                        alert('Xóa phần tử thất bại.Vui lòng thử lại!');
                    }
                    
                }
            })
            
            
        }
    }
});
$(document).ready(function() {
    window.loadMore = function(){
        const page = $('#page').val();
        
        
    }
})



const activeCheckbox = document.getElementById('active');
        const noActiveCheckbox = document.getElementById('no_active');

        activeCheckbox.addEventListener('change', () => {
            noActiveCheckbox.checked = !activeCheckbox.checked;
        });

        noActiveCheckbox.addEventListener('change', () => {
            activeCheckbox.checked = !noActiveCheckbox.checked;
        });

$(document).ready(function() {
    $('#image-input').on('change', function() {
        var file = this.files[0]; // Lấy file đã chọn
        
        if (file) {
            var reader = new FileReader(); // Sử dụng FileReader để đọc file
            
            reader.onload = function(e) {
                // Cập nhật src của hình ảnh khi file được đọc xong
                $('#preview-image').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(file); // Đọc file dưới dạng URL
        }
    });
});

$(document).ready(function() {
        $('#parent-category').on('change', function() {
            var parentId = $(this).val(); // Lấy giá trị của danh mục cha
            
            // Gọi AJAX để lấy danh mục con
            if (parentId) {
                $.ajax({
                    url: '/subcategories',
                    type: 'GET',
                    data: { parent_id: parentId },
                    success: function(data) {
                        // Xóa các lựa chọn cũ
                        $('#sub-category').empty();
                        $('#sub-category').append('<option value="">Chọn danh mục con</option>');

                        // Thêm các danh mục con mới vào select
                        $.each(data, function(key, value) {
                            $('#sub-category').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                // Nếu không chọn danh mục cha, reset danh mục con
                $('#sub-category').empty();
                $('#sub-category').append('<option value="">Chọn danh mục con</option>');
            }
        });
    });

    $(document).ready(function() {
        $('#imageInput').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#preview').attr('src', event.target.result).show(); // Hiển thị ảnh đã chọn
                }
                reader.readAsDataURL(file); // Đọc file dưới dạng URL
            } else {
                $('#preview').hide(); // Ẩn ảnh nếu không có file nào được chọn
            }
        });
    });

    

 