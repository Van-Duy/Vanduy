$(document).ready(function () {
    // xem sản phẩm qua modal
    viewModal = function (rootURL, id) {
        link = rootURL + 'index.php?module=frontend&controller=index&action=view';
        $.get(link, { 'id': id },
            function (data) {
                console.log(data);
                var name = data['name'];
                var sale = formatNumber(data['price'] - (data['price'] * data['sale_off'] / 100));
                var price = formatNumber(data['price']);
                var title = data['description'].substring(0, 300);
                var img = '<img src="' + data['src'] + '" alt="" class="w-100 img-fluid blur-up lazyload book-picture">';
                var buttton = '<a href="javascript:void(0)" onclick="buyProduct(\'' + rootURL + '\',' + id + ')" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a><a href="' + data['linkretail'] + '" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>';

                $('.book-name').html(name);
                $('.quick-view-img').html(img);
                $('.product-buttons').html(buttton);
                $('.book-price').html(sale + ' đ <del> ' + price + ' đ</del>');
                $('.book-description').html(title + '...');
            },
            'json'
        );
    }
    // mua sản phẩm
    buyProduct = function (rootURL, id) {
        var quantify = $('input[name=quantity]').val();
        if (quantify != null) { quantify = quantify } else { quantify = 1 };
        if (quantify > 0) {
            var link = rootURL + 'index.php?module=frontend&controller=user&action=buy';
            console.log(link);
            $.get(link, { 'id': id, 'quantify': quantify },
                function (data) {
                    quantify = data['quantify'];
                    $('#cart').notify("Đã thêm sản phẩm vào giỏ hàng", { position: "bottom-center", className: 'success', autoHideDelay: 2000 });
                    $('.badge-warning').html(quantify);
                    $('input[name=quantity]').val(1);

                }, 'json'
            );
        } else {
            toastr.error('Đã có lỗi do cố tình thay đổi', 'Cảnh báo !!!')
            $('input[name=quantity]').val(1);
        }

    }

    // hủy sản phẩm
    deleteProduct = function (id) {
        var link = 'index.php?module=frontend&controller=user&action=deleteProduct';
        var product = $('.badge-warning').html();
        $.get(link, { 'id': id },
            function (data) {
                var quantify = data['quantify'];
                var sumPrice = data['sumPrice'];
                var product = (product - quantify);

                $('.sumcart').html(formatNumber(sumPrice) + ' đ');
                $('.badge-warning').html(product);
                $('#cart').notify("Đã xóa " + quantify + " sản phẩm từ giỏ hàng !!!", { position: "bottom-center", className: 'warning', autoHideDelay: 2000 });
                $('tr[id=' + id + ']').fadeOut();
            },
            "json"
        );
    }

    // thay đổi số lượng 
    $('input[name=quantify]').change(function (e) {
        var quantify = $(this).val();
        if (quantify > 0) {
            var id = $(this).attr('id');
            var link = 'index.php?module=frontend&controller=user&action=changeQuantify';

            var priceSingle = $('tr[id=' + id + ']' + ' .price-single').attr('value');
            var priceNew = priceSingle * quantify;


            $.get(link, { 'id': id, 'quantify': quantify },
                function (data) {
                    var message = data['message'];
                    var sumQuantify = data['sumQuantify'];
                    var sumPrice = data['sumPrice'];

                    var a = $('input[id="form[quantify][]-' + id + '"').attr('value', quantify);
                    $('tr[id=' + id + ']' + ' .sumPrice').attr('value', priceNew);
                    $('tr[id=' + id + ']' + ' .sumPrice').html(formatNumber(priceNew) + ' đ');
                    $('.sumcart').html(formatNumber(sumPrice) + ' đ');
                    $('.badge-warning').html(sumQuantify);
                    $('#cart').notify(message, { position: "bottom-center", className: 'warning', autoHideDelay: 2000 });
                },
                "json"
            );
        } else {
            toastr.error('Đã có lỗi do cố tình thay đổi', 'Cảnh báo !!!')
            var quanti = $('input[name=quantify]').attr('value');
            $('input[name=quantify]').val(quanti);
        }
    });


    // sort category
    $('#sort-form select[name="sort"]').change(function () {
        sort = getUrlParam('sort');
        if(sort){
            $('#sort-form').append('<input type="hidden" name="sort" value="'+sort +'">');
        }
        $('#sort-form').submit();
    });

    // show more show less
    if ($('.category-item').length > 10) {
        $('.category-item:gt(9)').hide();
        $('#btn-view-more').show();
    }

    $('#btn-view-more').on('click', function () {
        $('.category-item:gt(9)').toggle();
        $(this).text() === 'Xem thêm' ? $(this).text('Thu gọn') : $(this).text('Xem thêm');
    });
});

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function getUrlParam(key) {
    let searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(key);
}