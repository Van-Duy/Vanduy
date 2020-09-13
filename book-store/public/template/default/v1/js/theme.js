$(document).ready(function () {
    var searchParams = new URLSearchParams(window.location.search);
    
    var moduleName = searchParams.get('module');
    var controllerName = searchParams.get('controller');
    
    addToCart = function(link){
        var quantify = $('input[name=quantify]').val();
        
        $.get(link,{'quantify' : quantify }, 
            function (data) {
                console.log(data);
                var price   = formatNumber(data['price']);
                var quanti  = data['quantify'];
            
            $('#simpleCart_quantity').html(quanti);
            $('span[class=simpleCartTotal]').html('$' + price);
            },"json"
        );

    }

    // hủy cart
    destroyCart = function (link) {
        $.get(link,
            function (data) {
                $('#simpleCart_quantity').html('0');
                $('span[class=simpleCartTotal]').html('');
            }
        );
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }


    payProduct = function (link) {
        $('#main-Form').attr('action',link);
        $('#main-Form').submit();
    }


    changeQuantify = function (id) {
        var value       = $('input[name=quantify'+id+']').val();
        var link        = 'index.php?module=fontend&controller=user&action=changeQuantify';
        var linkRe      = 'cart.html';
        $.get(link, {'idChange' : id,'quantifyChange' : value},
            function (data) {
                window.location.href = linkRe;
            }
        );
    }

    deleteQuantify = function (id) {
        var link        = 'index.php?module=fontend&controller=user&action=deleteQuantify';
        var linkRe      = 'cart.html';
        $.get(link, {'id' : id},
            function (data) {
                window.location.href = linkRe;
            }
        );
    }

    $('select[name=fill-select-category]').change(function (e) { 
        var value           = $(this).val();
        var URL = createLink(window.location.href);
        window.location.href = URL + '&fill=' + value;
    });
});

function createLink(exceptParams) {
    let pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    let searchParamsEntries = searchParams.entries();

    let link = pathname + '?';
    for (let pair of searchParamsEntries) {
        if (exceptParams.indexOf(pair[0]) == -1) {
            link += `${pair[0]}=${pair[1]}&`;
        }
    }
    return link;
}
