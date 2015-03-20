      <form role="form" method="get" action="search.php">
        <div class="input-group" style="margin-bottom:20px;">
              <input type="text" class="form-control" name="q" placeholder="Search for...">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-search"></span></button>
              </span>
            </div><!-- /input-group -->
      </form>


      <div class="row">
      <?php
          $jobObj = new Job();
          $allJobs = $jobObj->getJobs(3, 1);
          if(isset($allJobs->data) && !empty($allJobs->data))
          {
            foreach ($allJobs->data as $key => $job) {
            ?>

              <div class="col-md-3">
                <div class="thumbnail">
                  <img src="<?php if(isset($job['expert_user']['pic'])) echo $job['expert_user']['pic']; ?>">
                  <div class="caption">
                    <h4>
                      <?php if(isset($job['job_title'])) echo $job['job_title']; ?>
                    </h4>
                    <p>
                      <a class="btn btn-primary" href="job.php?id=<?php echo $job['id'];?>">View</a>
                    </p>
                  </div>
                </div>
              </div>
            <?php
            }
            if(count($allJobs->data) > 3)
            {
            ?>
              <a href="jobs.php" class="btn btn-primary" style="width:20%; margin-top :1.5%;">View All Jobs </a>
            <?php

            }
          }
      ?>
      </div>

<!--       <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header" style="margin-left:40%;">

          <a class="navbar-brand" href="#">See All Dream Jobs</a>

          </div>
        </div>
      </nav>       -->