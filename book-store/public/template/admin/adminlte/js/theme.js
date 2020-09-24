$(document).ready(function () {
    var searchParams = new URLSearchParams(window.location.search);
    var moduleName = searchParams.get('module');
    var controllerName = searchParams.get('controller');

    // Search 
    $('#btn-search').click(function (e) {
        e.preventDefault();
        value = $('input[name=search]').val()
        if (value != '') {
            let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'search'];
            let link = createLink(exceptParams);
            link += `search=${value}`;
            window.location.href = link;
        } else {
            toastr.error('Nhập nội dung cần tìm kiếm', 'Thực hiện!')
        }
    });

    // filter_category_name
    $('select[name=filter_category_name]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'filter_category_name'];
        let link = createLink(exceptParams);
        link += `filter_category_name=${$(this).val()}`;
        window.location.href = link;
    });

    // filter_group_name
    $('select[name=filter_group_name]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'filter_group_name'];
        let link = createLink(exceptParams);
        link += `filter_group_name=${$(this).val()}`;
        window.location.href = link;
    });

    // filter_showHome
    $('select[name=filter_showHome]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'filter_showHome'];
        let link = createLink(exceptParams);
        link += `filter_showHome=${$(this).val()}`;
        window.location.href = link;
    });

    // filter_special
    $('select[name=filter_special]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'filter_special'];
        let link = createLink(exceptParams);
        link += `filter_special=${$(this).val()}`;
        window.location.href = link;
    });

    // filter_sstatus
    $('select[name=status]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'status'];
        let link = createLink(exceptParams);
        link += `status=${$(this).val()}`;
        window.location.href = link;
    });

    // group_acp
    $('select[name=filter_group_acp]').change(function (e) {
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'filter_group_acp'];
        let link = createLink(exceptParams);
        link += `filter_group_acp=${$(this).val()}`;
        window.location.href = link;
    });

    // show ?check
    $('input[type=checkbox]').change(function (e) {
        var countChecked = $('input[name="checkbox[]"]:checked').length;
        console.log(countChecked);
        if (countChecked > 0) {
            $('#bulk-apply>span').removeAttr('style');
            $('#bulk-apply>span').html(countChecked);
        } else {
            $('#bulk-apply>span').attr('style', "display: none");
        }
    });

    // muti
    $('#bulk-apply').click(function (e) {
        e.preventDefault();
        var value = $('#bulk-action').val();
        var countChecked = $('input[name="checkbox[]"]:checked').length;
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=changeMuti&type=' + value;
        if (countChecked > 0) {
            // thực hiện muti
            switch (value) {
                case 'multi-active':
                    $('#form-table').attr('action', link);
                    $('#form-table').submit();
                    break;
                case 'multi-inactive':
                    $('#form-table').attr('action', link);
                    $('#form-table').submit();
                    break;
                case 'showhome-inactive':
                    $('#form-table').attr('action', link);
                    $('#form-table').submit();
                    break;
                case 'showhome-active':
                    $('#form-table').attr('action', link);
                    $('#form-table').submit();
                    break;
                case 'multi-delete':
                    Swal.fire({
                        title: 'Bạn chắc chắn muốn xóa?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $('#form-table').attr('action', link);
                            $('#form-table').submit();
                        }
                    })
                    break;

                default:
                    toastr.warning('Chọn hoạt động cần thực hiện', 'Apply!')
            }
        } else {
            toastr.info('Chọn ít nhất 1 ID để thao tác', 'Apply!')
        }
    });

    // thay đổi ordering
    $('input[name=chkOrdering]').change(function (e) {
        var value = $(this).val();
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=changeOrdering';
        var id = $(this).attr('id');
        var element = $(this);

        $.get(link, {
                'id': id,
                'value': value
            },
            function (data) {
                modified = 'modified-' + data['id'];
                $('.' + modified + '').html(data['modified']);
                element.notify("Cập nhật thành công", {
                    position: "top-center",
                    className: 'success',
                    autoHideDelay: 2000
                });
            }, 'json'
        );
    });

    //change Group ACP
    changeACP = function (link) {
        $.get(link,
            function (data) {
                modified = 'modified-' + data['id'];
                groupACP = 'groupACP-' + data['id'];
                $('.' + modified + '').html(data['modified']);
                $('.' + groupACP + '').html(data['groupACP']);
                toastr.success('Thay đổi GroupACP thành công', 'Thực hiện!')
            }, 'json'
        );
    }

    //change Special
    changeSpecial = function (link) {
        $.get(link,
            function (data) {
                modified = 'modified-' + data['id'];
                special = 'special-' + data['id'];
                $('.' + modified + '').html(data['modified']);
                $('.' + special + '').html(data['special']);
                toastr.success('Thay đổi Special thành công', 'Thực hiện!')
            }, 'json'
        );
    }

    //change showHome
    changeShowHome = function (link) {
        $.get(link,
            function (data) {
                console.log(data);
                showHome = 'showHome-' + data['id'];
                modified = 'modified-' + data['id'];
                $('.' + showHome + '').html(data['showHome']);
                $('.' + modified + '').html(data['modified']);
                toastr.success('Thay đổi ShowHome thành công', 'Thực hiện!')
            }, 'json'
        );
    }

    //thay đổi groupName
    $('select[name=groupName]').change(function (e) {
        var id = $(this).attr('id');
        var value = $(this).val();
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=changeGroupName';
        $.get(link, {
                'id': id,
                'value': value
            },
            function (data) {
                modified = 'modified-' + data['id'];
                $('.' + modified + '').html(data['modified']);
                toastr.success('Đã thay đổi thành công', 'Thành công!')
            }, 'json'
        );
    });

    //thay đổi category_name
    $('select[name=category_name]').change(function (e) {
        var id = $(this).attr('id');
        var value = $(this).val();
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=changeCategoryName';
        $.get(link, {
                'id': id,
                'value': value
            },
            function (data) {
                console.log(data);
                modified = 'modified-' + data['id'];
                $('.' + modified + '').html(data['modified']);
                toastr.success('Đã thay đổi thành công', 'Thành công!')
            }, 'json'
        );
    });

    //thay đổi status : name
    $('select[name=status_name]').change(function (e) {
        var id = $(this).attr('id');
        var value = $(this).val();
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=changeStatusName';
        $.get(link, {
                'id': id,
                'value': value
            },
            function (data) {
                toastr.success('Đã thay đổi thành công', 'Thành công!')
            }
        );
    });

    // ẩn thông báo
    $('#alert').fadeOut(5000);

    // trash single
    trashSingle = function (link) {
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = link;
            }
        })
    }

    // viewCart single
    viewCart = function (link) {
        window.location.href = link;
    }

    // click checkAll
    $('#check-all').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks);
    });

    // clear
    $('#btn-clear-search').click(function (e) {
        $('input[name=search]').val('');
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'search'];
        let link = createLink(exceptParams);
        window.location.href = link;
    });

    // form
    submitForm = function (link) {
        $('#form').attr('action', link);
        $('#form').submit();
    }

    // fillStatus
    $('.fillStatus').click(function (e) {
        e.preventDefault();
        value = $(this).attr('data');
        let exceptParams = ['filter_page', 'sort_field', 'sort_order', 'statusSearch'];
        let link = createLink(exceptParams);
        link += `statusSearch=${value}`;
        window.location.href = link;

    });


    // fillColum
    sortList = function (colum, oder) {
        $('input[name=sort_field]').val(colum);
        $('input[name=sort_order]').val(oder);
        $('#filter-bar').submit();
    };
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

// show massage
$(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
});
