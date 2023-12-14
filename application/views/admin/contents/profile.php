<div class="main-content container-fluid p-0">
  <div class="container-fluid dashboard-content">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h3 class="mb-2">Profile</h3>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card influencer-profile-data">
          <div class="card-body">
            <div class="row">
              <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="text-center">
                  <img src="<?php echo base_url('assets/images/avatar-1.jpg') ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                </div>
              </div>
              <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                <div class="user-avatar-info">
                  <div class="m-b-20">
                    <div class="user-avatar-name">
                      <h2 class="mb-1"><?php echo $this->session->NamaUser; ?></h2>
                    </div>
                    <div class="rating-star d-inline-block">
                      <i class="text-success fa-fw fas fa-circle"></i>
                      <p class="d-inline-block text-dark">Online</p>
                    </div>
                  </div>
                  <div class="user-avatar-address">
                    <p class="border-bottom pb-3">
                      <span class="mb-2 d-xl-inline-block d-block"><?php echo $this->session->Username; ?></span>
                    </p>
                    <div class="mt-3">
                      <i class="badge badge-light"><?php echo $this->session->LevelName; ?></i>
                      <?php if ($this->session->Level == 4) {
                      } else { ?>
                        <div class="float-right">
                          <a href="<?php echo base_url('admin/editprofile') ?>" class="badge badge-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>