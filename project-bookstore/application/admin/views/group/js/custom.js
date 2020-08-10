$(document).ready(function () {
    // click search-fillter
    $('#btn-search').click(function (e) { 
        $('#form-table').submit();
    });
    // click Clear
    $('#btn-clear-search').click(function (e) { 
        $('input[name=filter_search]').val('');
        $('select[name=search-by]').val('default');
        $('#form-table').submit();
    });

     // change groupAcp
    $('select[name=filter_groupAcp]').change(function (e) { 
        var value = $(this).val();
        console.log(value);
        $('#form-table').submit();
    });
  
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
        $(this).data('clicks', !clicks)
        });

    // hide Alert
    var divAlert = document.getElementById('alert');
    if(divAlert != null){
        $(divAlert).fadeOut(4000);
    }


});

// pagination
changPage = function (page) {
    $('input[name=page]').val(page);
    $('#form-table').submit();
}

//click save
submitForm = function(link){
    $('#form').attr('action',link);
    $('#form').submit()
}

// changeFillHeader
changeFillHeader = function(value){
    $.get("index.php?module=admin&controller=group&action=addSeccion", {'statusAll' : value},
        function (data) {
            $('a[name=statusAll]').removeClass('btn-info').addClass('btn-secondary');
            $('a[data=data-'+value+']').removeClass('btn-secondary').addClass('btn-info');
        },
        
    );
}

// fillColum
sortList = function(colum,oder) {
    $('input[name=namePost]').val(colum);
    $('input[name=namePostDir]').val(oder);
    $('#form-table').submit();
};

$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 4000
    });
    // delete 1 
    trash = function(id){
            
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
                $.get("index.php?module=admin&controller=group&action=trash",{'id' : id},
                function (data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Đã xóa phần tử id = '+data['id']+' thành công.'
                    })
                    $('tr[data=data-'+data['id']+']').fadeOut(1000,function(){

                    
                   

                    // thực hiện xóa
                    var parent = $('tr[data=data-'+data['id']+'').parent();
                    var lastID = $(parent).children(":last").attr("data");
                    $.get("index.php?module=admin&controller=group&action=lastIdGet", {'id' : lastID},
                        function (data) {
                            if(data['group_acp'] == 1){
                                var icon = 'check';
                                var classG = 'success';
                            }else{
                                icon = 'minus';
                                classG = 'danger';
                            }
                            var classStatus    = (data['status'] == 1) ? "success" : "warning";
                            if(data['status'] == 1){
                                var selectAc = 'selected="selected"' ;
                                var selectIn = '';
                            }else{
                                selectAc = '';
                                selectIn = 'selected="selected"' ;
                            }
                            var status         = '<select style="width: unset" name="status" class="custom-select custom-select-sm text-white bg-'+classStatus+'" id="'+data['id']+'" data="data-'+data['id']+'"><option '+selectAc+' value="1">Active</option><option '+selectIn+' value="0">Inactive</option></select>'
                            console.log(data);
                            var str = '<tr data="data-'+data['id']+'">'
                                        +    '<td class="text-center"><div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" name="checkbox" id="id-'+data['id']+'" value="'+data['id']+'"><label for="id-'+data['id']+'" class="custom-control-label"></label></div></td>'
                                        +    '<td class="text-center">'+data['id']+'</td>'
                                        +    '<td class="text-center">'+data['name']+'</td>'
                                        +    '<td class="text-center">'+status+'</td>'
                                        +    '<td class="text-center position-relative"><a id="id-'+data['id']+'" href="javascript:changeGroupAcp(\'index.php?module=admin&controller=group&action=changeGroupAcp&group='+data['group_acp']+'&id='+data['id']+'\')" class="my-btn-state rounded-circle btn btn-sm btn-'+classG+'"><i class="fas fa-'+icon+'"></i></a></td>'
                                        +    '<td class="text-center position-relative"><input type="number" name="chkOrdering['+data['id']+']" value="'+data['ordering']+'" class="chkOrdering form-control form-control-sm m-auto text-center" style="width: 65px" data-id="1" min="1"></td>'
                                        +    '<td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'+data['created_by']+'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'+data['created']+'</p></td>'
                                        +   '<td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'+data['modified_by']+'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'+data['modified']+'</p></td>'
                                        +    '<td class="text-center">'
                                        +    '<a href="" class="rounded-circle btn btn-sm btn-info" title="Edit">'
                                        +    '<i class="fas fa-pencil-alt"></i></a>'
                                        +    '<a href="javascript:trash('+data['id']+')" class="rounded-circle btn btn-sm btn-danger" title="Delete">'
                                        +    '<i class="fas fa-trash-alt"></i></a></td>'
                                        + '</tr>';
                                        str = $(str).hide().appendTo(parent);
                                        $(str).fadeIn(2000);
                            },
                            'json'
                        );
                    });
                },
                "json"
                );
            }
          })
       
    };

      // change status
    $('select[name=status]').change(function (e) { 
    var value = $(this).val();
    var id   = $(this).attr('id');
    console.log(id);
    $.get("index.php?module=admin&controller=group&action=changeStatus",{'id' : id , 'value' : value},
        function (data) {
            Toast.fire({
                icon: 'success',
                title: 'Thay đổi status thành công.'
            });
            $('select[id='+data['id']+']').removeClass('bg-success').addClass('bg-warning');
            if(data['status'] == 1){
                $('select[id='+data['id']+']').removeClass('bg-warning').addClass('bg-success');
            };
        },
        'json'
    );
    });

    // change GroupAcp
    changeGroupAcp = function (link) {
        $.get(link,
            function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Thay đổi group_Acp thành công.'
                });
                var  element        = "a#id-" + data['id'];
    
                var removeIcon      = 'fa-check';
                var addIcon         = 'fa-minus';
                var  removeClass    = 'btn-success';
                var  addClass       = 'btn-danger';
                if(data['group'] == 1){
                    removeClass     = 'btn-danger';
                    addClass        = 'btn-success';
                    removeIcon      = 'fa-minus';
                    addIcon         = 'fa-check';
                }
    
                $(element).attr('href',"javascript:changeGroupAcp('"+ data['url']+"')");
                $(element).removeClass(removeClass).addClass(addClass);
                $(element + ' i').removeClass(removeIcon).addClass(addIcon);
    
    
            },
            "json"
        );
    };

    // upload Ordering
    reload = function(link) {
        Toast.fire({
            icon: 'success',
            title: 'Đã cập nhật lại Ordering...'
        })
        $('#form-table').attr('action',link);
        $('#form-table').submit();
        
    };

    // muty
    $('select[name=muti-change]').change(function (e) { 
        var select   = $(this).val();
        var checkbox = document.getElementsByName('checkbox');
        var id = "";
        // Lặp qua từng checkbox để lấy giá trị
        for (var i = 0; i < checkbox.length; i++){
            if (checkbox[i].checked === true){
                id +=  checkbox[i].value + ',';
            }
        }
        if((id != "")){
            if(select == 2){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.get("index.php?module=admin&controller=group&action=ChangeAll",{'type' : select,'id' : id},
                        function (data) {
                            
                            data['id'].split(',').forEach(element => {
                                $('tr[data=data-'+element+']').fadeOut(1000,function() {
                                    var parent = $('tr[data=data-'+element+'').parent();
                                    var lastID = $(parent).children(":last").attr("data");
                                    $.get("index.php?module=admin&controller=group&action=lastIdGet", {'id' : lastID},
                                        function (data) {
                                            if(data['group_acp'] == 1){
                                                var icon = 'check';
                                                var classG = 'success';
                                            }else{
                                                icon = 'minus';
                                                classG = 'danger';
                                            }
                                            var classStatus    = (data['status'] == 1) ? "success" : "warning";
                                            if(data['status'] == 1){
                                                var selectAc = 'selected="selected"' ;
                                                var selectIn = '';
                                            }else{
                                                selectAc = '';
                                                selectIn = 'selected="selected"' ;
                                            }
                                            var status         = '<select style="width: unset" name="status" class="custom-select custom-select-sm text-white bg-'+classStatus+'" id="'+data['id']+'" data="data-'+data['id']+'"><option '+selectAc+' value="1">Active</option><option '+selectIn+' value="0">Inactive</option></select>'
                                            console.log(data);
                                            var str = '<tr data="data-'+data['id']+'">'
                                                        +    '<td class="text-center"><div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" name="checkbox" id="id-'+data['id']+'" value="'+data['id']+'"><label for="id-'+data['id']+'" class="custom-control-label"></label></div></td>'
                                                        +    '<td class="text-center">'+data['id']+'</td>'
                                                        +    '<td class="text-center">'+data['name']+'</td>'
                                                        +    '<td class="text-center">'+status+'</td>'
                                                        +    '<td class="text-center position-relative"><a id="id-'+data['id']+'" href="javascript:changeGroupAcp(\'index.php?module=admin&controller=group&action=changeGroupAcp&group='+data['group_acp']+'&id='+data['id']+'\')" class="my-btn-state rounded-circle btn btn-sm btn-'+classG+'"><i class="fas fa-'+icon+'"></i></a></td>'
                                                        +    '<td class="text-center position-relative"><input type="number" name="chkOrdering['+data['id']+']" value="'+data['ordering']+'" class="chkOrdering form-control form-control-sm m-auto text-center" style="width: 65px" data-id="1" min="1"></td>'
                                                        +    '<td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'+data['created_by']+'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'+data['created']+'</p></td>'
                                                        +   '<td class="text-center"><p class="mb-0 history-by"><i class="far fa-user"></i>'+data['modified_by']+'</p><p class="mb-0 history-time"><i class="far fa-clock"></i>'+data['modified']+'</p></td>'
                                                        +    '<td class="text-center">'
                                                        +    '<a href="" class="rounded-circle btn btn-sm btn-info" title="Edit">'
                                                        +    '<i class="fas fa-pencil-alt"></i></a>'
                                                        +    '<a href="javascript:trash('+data['id']+')" class="rounded-circle btn btn-sm btn-danger" title="Delete">'
                                                        +    '<i class="fas fa-trash-alt"></i></a></td>'
                                                        + '</tr>';
                                                        str = $(str).hide().appendTo(parent);
                                                        $(str).fadeIn(2000);
                                            },
                                            'json'
                                        );
                                });


                               
                            });



                                console.log(data);
                                Toast.fire({
                                icon: 'success',
                                title: data['success']
                                });
                        },
                        'json'
                        );
                    }else{
                        $('select[name=muti-change] option').removeAttr('selected');
                        $('select[name=muti-change] option[value=default]').attr('selected','selected');
                    }
                })
            }; 
        if(select != 'default' && select != 2){
                $.get("index.php?module=admin&controller=group&action=ChangeAll",{'type' : select,'id' : id},
                function (data) {
                    if(data['number'] == 0){
                        Toast.fire({
                            icon: 'warning',
                            title: 'Không có phần tử nào được thay đổi !!!'
                        }); 
                        $('select[name=muti-change] option').removeAttr('selected');
                        $('select[name=muti-change] option[value=default]').attr('selected','selected');
                    }else{
                        Toast.fire({
                        icon: 'success',
                        title: data['success']
                        });
                        cID = id.split(',');
                      
                        cID.forEach(element => {
                            console.log(element);
                            if(select == 0){
                                  $('select[data=data-'+element+']').removeClass('bg-success').addClass('bg-warning');
                                  $('select[data=data-'+element+'] option[selected=selected]').removeAttr('selected');
                                  $('select[data=data-'+element+'] option[value=0]').attr('selected','selected');
                            }else if(select == 1){
                                $('select[data=data-'+element+']').removeClass('bg-warning').addClass('bg-success');
                                $('select[data=data-'+element+'] option[selected=selected]').removeAttr('selected');
                                $('select[data=data-'+element+'] option[value=1]').attr('selected','selected');
                            }
                        });
                    }
                },
                'json'
                );
        }
        }else{
            Toast.fire({
                icon: 'error',
                title: ' Vui lòng check ID cần thay đổi'
            });
            $('select[name=muti-change] option').removeAttr('selected');
            $('select[name=muti-change] option[value=default]').attr('selected','selected');
        }
       
    });  
});

