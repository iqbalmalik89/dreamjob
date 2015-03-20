
var server = window.location.hostname;
if(server == 'localhost')
  var apiUrl = location.protocol + "//"+server+"/dreamjob/lib/api.php";
else
  var apiUrl = location.protocol + "//"+server+"/makeawish/lib/api.php";


function showMsg(id, msg, type)
{
    $(id).html(msg).addClass(type).slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass(type)}); 
}

function login()
{
    var email = $.trim($('#email').val());
    var password = $.trim($('#password').val());    
    var check = true;

    if(email == '')
    {
        $('#email').focus();
        $('#email').addClass('error-class');
        check = false;
    }

    if(password == '')
    {
        $('#password').focus();
        $('#password').addClass('error-class');
        check = false;
    }

    if(check)
    {
        $('#spinner').show();
        $.ajax({
          type: 'POST',
          url: apiUrl,
          dataType : "JSON",
          data: { email: email, password: password, action: "login" },
          beforeSend:function(){

          },
          success:function(data){
            $('#spinner').hide();
            if(data.status == 'success')
            {
                showMsg('#msg', 'Successfully Logged In. Redirecting ...', 'green')
                window.location = 'pendingjobs.php';
            }
            else
            {
              showMsg('#msg', 'Wrong credentials. Try Again', 'red')
            }
          },
          error:function(jqxhr){
          }
        });

    }
}

function logout()
{
    $.ajax({
      type: 'GET',
      url: apiUrl,
      dataType : "JSON",
      data: {action:"logout"},
      beforeSend:function(){

      },
      success:function(data){
        window.location = 'login.php';
      },
      error:function(jqxhr){
      }
    });
}



function getPendingJobs(status, page)
{
  curpage = page;
  if(page > 0)
    page -= 1;

    $.ajax({
      type: 'GET',
      url: apiUrl,
      dataType : "JSON",
      data: {action:"get_all_jobs", status:status, page:page},
      beforeSend:function(){

      },
      success:function(data){
        var html = '';

        $.each(data.data, function( index, job ) {

          html += '<tr>\
                      <td>'+job.job_title+'</td>\
                      <td><img src="'+job.user.pic+'" class="img-circle">  <span>'+job.user.name+' </span></td>\
                      <td><img src="'+job.expert_user.pic+'" class="img-circle">  <span>'+job.expert_user.name+' </span></td>\
                      <td>'+job.user_msg+'</td>\
                      <td>'+job.created_date+'</td>\
                   </tr>';

        });

        $('#htmlbody').html(html);        

        nohtml = '<tr>\
                        <td colspan="4" align="center">No Jobs found.</td>\
                     </tr>';

      if(html == '')
        $('#htmlbody').html(nohtml);        

        $('#htmlpagination').bootpag({
            total: data.total_pages,          // total pages
            page: curpage,            // default page
            maxVisible: 5,     // visible pagination
            leaps: true         // next/prev leaps through maxVisible
        }).on("page", function(event, num){
          getPendingJobs(status, num);
        }); 

      },
      error:function(jqxhr){
      }
    });
}

function changeJobStaus(job_id, status)
{

    $.ajax({
      type: 'POST',
      url: apiUrl,
      dataType : "JSON",
      data: {action:"job_status", job_id:job_id, status:status},
      beforeSend:function(){

      },
      success:function(data){
        showMsg('#msg', 'Job status has been changed', 'green')
        if(status ==  'live' )
          getExpertJobs('approved', 1);
        else if(status ==  'approved' )
          getLiveJobs('live', 1);

      },
      error:function(jqxhr){
      }
    });

}



function getExpertJobs(status, page)
{
  curpage = page;
  if(page > 0)
    page -= 1;

    $.ajax({
      type: 'GET',
      url: apiUrl,
      dataType : "JSON",
      data: {action:"get_all_jobs", status:status, page:page},
      beforeSend:function(){

      },
      success:function(data){
        var html = '';

        $.each(data.data, function( index, job ) {

          html += '<tr>\
                      <td>'+job.job_title+'</td>\
                      <td><img src="'+job.user.pic+'" class="img-circle">  <span>'+job.user.name+' </span></td>\
                      <td><img src="'+job.expert_user.pic+'" class="img-circle">  <span>'+job.expert_user.name+' </span></td>\
                      <td>'+job.user_msg+'</td>\
                      <td><a href="edit_job?id='+job.id+'">Edit Job</a> | <a href="javascript:void(0);" onclick="changeJobStaus('+job.id+', \'live\')">Approve Job</a></td>\
                   </tr>';

        });

        $('#htmlbody').html(html);        

        nohtml = '<tr>\
                        <td colspan="5" align="center">No Jobs found.</td>\
                     </tr>';

      if(html == '')
        $('#htmlbody').html(nohtml);        

        $('#htmlpagination').bootpag({
            total: data.total_pages,          // total pages
            page: curpage,            // default page
            maxVisible: 5,     // visible pagination
            leaps: true         // next/prev leaps through maxVisible
        }).on("page", function(event, num){
          getExpertJobs(status, num);
        }); 

      },
      error:function(jqxhr){
      }
    });
}


function getLiveJobs(status, page)
{
  curpage = page;
  if(page > 0)
    page -= 1;

    $.ajax({
      type: 'GET',
      url: apiUrl,
      dataType : "JSON",
      data: {action:"get_all_jobs", status:status, page:page},
      beforeSend:function(){

      },
      success:function(data){
        var html = '';

        $.each(data.data, function( index, job ) {

          html += '<tr>\
                      <td>'+job.job_title+'</td>\
                      <td><img src="'+job.user.pic+'" class="img-circle">  <span>'+job.user.name+' </span></td>\
                      <td><img src="'+job.expert_user.pic+'" class="img-circle">  <span>'+job.expert_user.name+' </span></td>\
                      <td>'+job.user_msg+'</td>\
                      <td><a href="edit_job?id='+job.id+'">Edit Job</a> | <a href="javascript:void(0);" onclick="changeJobStaus('+job.id+', \'approved\')">Disapprove Job</a></td>\
                   </tr>';

        });

        $('#htmlbody').html(html);        

        nohtml = '<tr>\
                        <td colspan="5" align="center">No Jobs found.</td>\
                     </tr>';

      if(html == '')
        $('#htmlbody').html(nohtml);        

        $('#htmlpagination').bootpag({
            total: data.total_pages,          // total pages
            page: curpage,            // default page
            maxVisible: 5,     // visible pagination
            leaps: true         // next/prev leaps through maxVisible
        }).on("page", function(event, num){
          getLiveJobs(status, num);
        }); 

      },
      error:function(jqxhr){
      }
    });
}