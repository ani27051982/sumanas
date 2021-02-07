$(document).ready(function()
{
    $(".alert").hide();
    $.validator.addMethod('alphanumericformat', function(value, element, param)
    {
        var _URL = window.URL;
        var  pattern=/^[A-z a-z 0-9.]+$/;
        var $el=$(element);
        return $el.val().match(pattern);          
    });
    
    $("#courseFrm").validate
    ({
            rules: 
            {
                    name: {
                        required: true,
                        alphanumericformat: true
                    },
                    short_name:
                    {
                        required: true,
                        alphanumericformat: true
                    },
                    menu_name:
                    {
                        required: true,
                        alphanumericformat: true
                    },
                    order_by:
                    {        
                        required: true,
                        number: true,
                        minlength: 2
                    },
                    status: {
                        required : true
                    }
            },
            messages: 
            {
                    name: {
                        required: "Please enter course name",
                        alphanumericformat: "Please enter course name in characters only and . is allowed"  
                    },
                    short_name: 
                    {
                        required: "Please enter course short name",
                        alphanumericformat: "Please enter course short name in characters only and . is allowed" 

                    },
                    menu_name: 
                    {
                        required: "Please enter course menu name",
                        alphanumericformat: "Please enter course menu name in characters only and . is allowed"
                    },
                    order_by:
                    {
                        required: "Please enter order by",
                        number: "Please enter order by in numbers only",
                        minlength: "Please enter order by atleast 2 numbers"
                    },
                    status : {
                        required: "Please check course status"
                    }
            },
            errorElement: 'span',
            errorElementClass: 'pdt_error_class_validate',
            errorClass: 'pdt_error_class_validate',
            errorPlacement: function(error, element) {},
            highlight: function(element, errorClass, validClass) {
                    if(!$(element).is(":checkbox")) {
                        $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                        $(element).parent().removeClass("is-valid");
                        $(element).parent().addClass("is-invalid");
                    }

            },
            unhighlight: function(element, errorClass, validClass) {
                if(!$(element).is(":checkbox")) {
                    $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
                    $(element).parent().removeClass("is-invalid");
                    $(element).parent().addClass("is-valid");
                }
            },
//		onkeyup: false,
//		onclick: false,
//		onfocusout: false,
            errorPlacement: function (error, element) { if ( element.is(":checkbox") ) { error.insertAfter(".customCheckRegister"); } else {  error.insertAfter(element.parent()); } }
	});

    
    $(document).on("click", ".selectall", function() {
        //alert('hi');
        $(".course_id").prop('checked', $(this).prop('checked'));
    });
    
    $(document).on("click", ".course_id", function() {
        if($(this).prop('checked')) {
            if ($('.courseDetails input[name="btSelectItem[]"]').filter(':checked').length == $('.courseDetails input[name="btSelectItem[]"]').length) {
                $(".selectall").prop('checked', true);
            } 
        } else {
            $(".selectall").prop('checked', false);
        }
    });
    
    $(document).on("click", ".courseStatus", function() {
        //alert('hi');
        var courseStatus;
        if($(this).is(":checked")) {
            courseStatus = "1";
        } else {
            courseStatus = "2";
        }
        $(".edit_course_id").val($(this).attr("data-id"));
        addUpdateCourse("editCourseStatus", courseStatus);        
    });
    
    $(document).on("click", ".table-action-edit", function() {
        //alert('hi');
        $(".edit_course_id").val($(this).attr("data-id"));
        getCourseDetails();
    });
    
    $(document).on('click', '.deleteCourse', function() {
        if ($('.courseDetails input[name="btSelectItem[]"]').filter(':checked').length === 0) {
            swal
            ({
                title: 'Error',
                text: 'Please select any course',
                type: 'error',
                confirmButtonClass: "btn-success"
            })
        } else {
            deleteCourse('multiple');
        }
    });
    
    $(document).on('click', '.table-action-delete', function() {
       $(".selectall").prop('checked', false);
       $(".course_id").prop('checked', false);
       $(this).parent().parent().parent().parent().find("input[name='btSelectItem[]']").prop('checked', true);
       deleteCourse('single');

    });
    
    $(document).on("click", ".addCourse", function() {
        //alert('hi');
        $("#modal-form").find(".pdt_error_class_validate").remove();
        $("#modal-form").find(".input-group").removeClass("is-invalid");
        $("#modal-form").find(".input-group").removeClass("is-valid");
        $("#modal-form").find(".form-control").val("");
        $("#modal-form").find(".status").prop("checked", false);
        $("#modal-form .modal-title").text("Add New Course");
        $(".saveUpdate").removeClass("disabled");
        $(".saveUpdate").text("Save");
        $(".saveUpdate").removeAttr("disabled");
        $(".edit_course_id").val("");
        $("#modal-form").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    
});

$(".saveUpdate").on("click", function(e)
{
    if(!$(".saveUpdate").hasClass("disabled")) {

        if ($('#courseFrm').valid())
        {
            //$("#loginfrm").submit();
            $(".saveUpdate").addClass("disabled");
            $(".saveUpdate").attr("disabled", true);
            if($(".edit_course_id").val()== "") {
                addUpdateCourse("add", "");
            } else {
                addUpdateCourse("editAll", "");
            }
        }
    }
});

function queryParamsCourse(params) {
    
    params.search = $(".courseDetails .fixed-table-toolbar .search input[type=text]").val();
    return params;
}

function addUpdateCourse(command, courseStatus) {
   
    var promiseObj = new Promise(function(resolve, reject) {
        client_course=GetXmlHttpObject();
        if (client_course==null) {
            alert ("Your browser does not support AJAX!");
            return;
        }
        
        var token = $('meta[name="csrf-token"]').attr('content');
        //alert(token);
        var formData = new FormData();
        if(command == "add" || command == "editAll") {
            
            if($('input[name="status"]:checked').length > 0) {
                courseStatus = "1";
            } else {
                courseStatus = "2";
            }
            formData.append("command",command);
            formData.append("course_id",$(".edit_course_id").val());        
            formData.append("name",$(".name").val());
            formData.append("short_name",$(".short_name").val());
            formData.append("menu_name",$(".menu_name").val());
            formData.append("order_by",$(".order_by").val());
        } else {
            courseStatus = courseStatus;            
        }
        //alert(courseStatus);
        formData.append("status",courseStatus);
        if($(".edit_course_id").val()!== "") {
            
            url = $(".site_url").val()+"/restricted/course/"+$(".edit_course_id").val()+"?_method=PUT";  
            client_course.open("POST", url, true);
        } else {
            url = $(".site_url").val()+"/restricted/course";  
            //alert(url);
            client_course.open("POST", url, true);
        }
        
        if (token) {
            client_course.setRequestHeader("X-CSRF-TOKEN", token);
        }
        else {
            client_course.setRequestHeader("enctype", "multipart/form-data");
        }
        client_course.send(formData);
        client_course.onreadystatechange = function() {
            if (client_course.readyState === 4) {
                if (client_course.status === 200) {
                    $(".saveUpdate").removeClass("disabled");
                    $(".saveUpdate").removeAttr("disabled");
                    response_course=JSON.parse(client_course.responseText);
                    ///alert(response_login.errors);
//                    if(response_course.status == false) {
                        if(response_course.status == "success") {
                            $('meta[name="csrf-token"]').attr('content', response_course.token);
                            if(command == "add" || command == "editAll") {
                                $('#modal-form').modal('toggle');
                                $("#modal-form").find(".input-group").removeClass("is-invalid");
                                $("#modal-form").find(".input-group").removeClass("is-valid");
                                $("#modal-form").find(".form-control").val("");
                                $("#modal-form").find(".status").prop("checked", false);
                            }
                            $(".alert-text").text(response_course.message);
                            $(".alert").removeClass("alert-danger");
                            $(".alert").removeClass("alert-success");
                            $(".alert").addClass("alert-success");
                            $(".close").hide();
                            $(".alert").fadeIn().fadeOut(4000);
                            $("#dashboardUsersCategoryTable").bootstrapTable('refresh');
                        } else {
                            $.each(response_course.data,function(key, value){
                                var error = '<span id='+key+'-error class="pdt_error_class_validate">'+value+'</span>';
                                $("."+key).parent().removeClass("is-valid");
                                $("."+key).parent().removeClass("is-invalid");
                                $("."+key).parent().addClass("is-invalid");
                                var element = $("."+key).parent();
                                $("#"+key+"-error").remove();
                                $(error).insertAfter(element);
                            
                            });
                        }
//                    } else {
//                        
//                    }
                }
            }
        }
    });
}

function getCourseDetails() {
    var promiseObj = new Promise(function(resolve, reject) {
        client_course=GetXmlHttpObject();
        if (client_course==null) {
            alert ("Your browser does not support AJAX!");
            return;
        }
        
        var token = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData();
        url = $(".site_url").val()+"/restricted/course/"+$(".edit_course_id").val()+"/edit";  
        client_course.open("GET", url, true);
        if (token) {
            client_course.setRequestHeader("X-CSRF-TOKEN", token);
        }
        else {
            client_course.setRequestHeader("enctype", "multipart/form-data");
        }
        client_course.send(formData);
        client_course.onreadystatechange = function() {
            if (client_course.readyState === 4) {
                if (client_course.status === 200) {
                    response_course=JSON.parse(client_course.responseText);
                    if(response_course.status == "success") {
                        $('meta[name="csrf-token"]').attr('content', response_course.token);
                        
                        $("#modal-form").find(".input-group").removeClass("is-invalid");
                        $("#modal-form").find(".input-group").removeClass("is-valid");
                        $("#modal-form .modal-title").text("Edit " + response_course.data.name);
                        $(".name").val(response_course.data.name);
                        $(".short_name").val(response_course.data.short_name);
                        $(".order_by").val(response_course.data.order_by);
                        $(".menu_name").val(response_course.data.menu_name);
                        if(response_course.data.status == "1") {
                            $(".status").prop('checked', true);
                        } else {
                            $(".status").prop('checked', false);
                        }
                        $(".saveUpdate").text("Update");
                        $('#modal-form').modal('toggle');
                    } else {
                        $(".alert-text").text(response_course.message);
                        $(".alert").removeClass("alert-danger");
                        $(".alert").removeClass("alert-success");
                        $(".alert").addClass("alert-danger");
                        $(".close").hide();
                        $(".alert").fadeIn().fadeOut(4000);                        
                    }
                }
            }
        }
    });
}

function deleteCourse(deletingCategory) {
    //alert($("#dashboardUsersVideoTable").find('input[name="btSelectItem"]:checked').val());
    Swal.fire({
    title: 'Are you sure, you want to delete this course?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: "#CCCCCC",
    confirmButtonText: 'Yes, delete it!',
    allowOutsideClick: false
    
    }).then((result) => {
        if(result.isConfirmed) {
            deleteFinalMethod('course', deletingCategory).then(deleteResponse, errorHandler);
        } else if (result.isDismissed) {
            $('.selectall').prop("checked", false);
            $('.courseDetails input[name="btSelectItem[]"]').prop("checked", false);
        }
    });
}

function deleteFinalMethod(deleteWhat, deleteCategory) {
    var deleteWhat = deleteWhat;
    var deleteCategory = deleteCategory;
    var url = "";
    var promiseObj = new Promise(function(resolve, reject) {
        client_delete=GetXmlHttpObject();
        if (client_delete==null)
        {
              alert ("Your browser does not support AJAX!");
              return;
        }
	 
        var token = $('meta[name="csrf-token"]').attr('content');
        //alert(token);
        var formData = new FormData();
        if(deleteWhat === "course" && deleteCategory === "single") {
            var course_id = $("#dashboardUsersCategoryTable").find('input[name="btSelectItem[]"]:checked').val();
            url = $(".site_url").val()+"/restricted/course/"+course_id;  
            //alert(url);
            client_delete.open("DELETE", url, true);
        } else if(deleteWhat === "course" && deleteCategory === "multiple") {
            $("#dashboardUsersCategoryTable").find('input[name="btSelectItem[]"]:checked').each(function() { 
                formData.append("course_id[]",$(this).val());
            });
                       
            url = $(".site_url").val()+"/restricted/course/multipleCourseDelete";
            client_delete.open("POST", url, true);
        } 
        if (token) {
            client_delete.setRequestHeader("X-CSRF-TOKEN", token);
        }
        else
        {
            client_delete.setRequestHeader("enctype", "multipart/form-data");
        }
        client_delete.send(formData);
        client_delete.onreadystatechange = function() {
            if (client_delete.readyState === 4) {
                if (client_delete.status === 200) {
                //alert(client_delete.responseText);
                    response_delete=JSON.parse(client_delete.responseText);
                    //alert(response_delete.message);
                    
                    if(response_delete.status == "success") {
                        response_delete.type = "success";
                        response_delete.title = "Record Deleted Successfully";
                        resolve(response_delete);
//                        resolve(response_delete, 'success', 'Record Deleted Successfully');
                    } else {
                        response_delete.type = "error";
                        response_delete.title = "Some error occured, please try later";
                        resolve(response_delete);
//                        resolve(response_delete, 'danger', 'Some error occured, please try later');
                    }
                } else {
                    $('.courseDetails input[name="btSelectAll"]').prop("checked", false);
                    $('.courseDetails input[name="btSelectItem[]"]').prop("checked", false);
                    
                    client_delete.type = "error";
                    client_delete.title = "Some error occured, please try later";
                    reject(client_delete);
//                    reject(client_delete.status, 'danger', 'Some error occured, please try later');
                }
            } else {
         	
            }
  	}
    });
    return promiseObj;
}

function deleteResponse(response) {
    var message = response["message"];
    var title = response.title;
    var type = response.type;
    //alert(type);
    Swal.fire
    ({
        title: title,
        text: message,
        icon: type,
        allowOutsideClick: false    
    }).then(function()
    {       
        $("#dashboardUsersCategoryTable").bootstrapTable('refresh');        
    });
}

function errorHandler(response) {
    var message = response["message"];
    var title = response.title;
    var type = response.type;
    Swal.fire
    ({
        icon: type,
        title: title,
	text: response,
	showCancelButton: true,
	cancelButtonColor: "#CCCCCC",
	confirmButtonText: 'Ok!'
    }).then(function() {
		
		   
    });
}
