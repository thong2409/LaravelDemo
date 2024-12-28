$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    window.loadMore = function(){        
        const page = $('#page').val();
        $.ajax({
            type:'POST',
            dataType: 'json',
            data: { page },
            url: 'services/load-product',
            success:function(result){
                if(result.html != ' '){
                    $('#loadProducts').append(result.html);
                    $('#page').val(page + 1);
                    
                } else{
                    alert('Đã load xong sản phẩm')
                    $('#button-loadMore').css('display', 'none');
                }
                
            }
        })
    }
})

$(document).on('click', '.js-quick-view', function (e) {
    e.preventDefault();
    
    // Lấy id sản phẩm từ thuộc tính data-id
    var productId = $(this).data('id');
    // Gửi Ajax để lấy thông tin sản phẩm
    $.ajax({
        url: '/get-product-info/' + productId, // Thay bằng route của bạn
        type: 'GET',
        success: function (data) {
            // Cập nhật modal với thông tin sản phẩm
            $('#modalId .modal-body').html(data);
        },
        error: function (err) {
            console.error('Không thể tải thông tin sản phẩm', err);
        }
    });
});