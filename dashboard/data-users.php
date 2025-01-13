<?php include('../config.php');

function isDataExist($conn, $email) {
  $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  return $count > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "add") {
  $username = htmlspecialchars(trim($_POST['username']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $role = htmlspecialchars(trim($_POST['role']));

  if (isDataExist($conn, $email)) {
    $error = 'Email sudah terdaftar. Silakan pilih yang lain.';
  } else {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        $message = 'Data berhasil ditambahkan';
    } else {
        $error = 'Gagal menambahkan data ke database';
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "edit") {
  $id = $_POST['id'];
  $username = htmlspecialchars(trim($_POST['username']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $role = htmlspecialchars(trim($_POST['role']));

  $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id = ?");
  $stmt->bind_param("ssssi", $username, $email, $password, $role, $id);

  if ($stmt->execute()) {
      $message = 'Data berhasil diperbarui';
  } else {
      $error = 'Gagal memperbarui data ke database';
  }
}

if (isset($_GET['delete'])) {
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $_GET['delete']);

  if ($stmt->execute()) {
    $message = 'Data berhasil dihapus';
  } else {
    $error = 'Gagal menghapus data';
  }
}
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Arkara Bhayana</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Arkara Bhayana | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

    <?php include('./navbar.php'); ?>
    
      <!--end::Header-->
      <!--begin::Sidebar-->

      <?php include('./sidebar.php'); ?>

      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Data Users</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Users</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-12 col-12">
                <div class="card">
                  <div class="card-header text-end">
                    <button onclick="openModal('add')" class="btn btn-success btn-sm">Tambah Data</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($users->num_rows > 0): ?>
                          <?php $no = 1; ?>
                          <?php while ($row = $users->fetch_assoc()): ?>
                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo htmlspecialchars($row['username']); ?></td>
                              <td><?php echo htmlspecialchars($row['email']); ?></td>
                              <td><?php echo htmlspecialchars($row['password']); ?></td>
                              <td><?php echo $row['role'] === 'admin' ? 'Admin' : 'Pengguna'; ?></td>
                              <td>
                                <button onclick='openModal("edit", <?php echo json_encode($row); ?>)' class="btn btn-primary btn-sm">Edit</button>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                              </td>
                            </tr>
                          <?php endwhile; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="6" class="text-center">Tidak ada data untuk ditampilkan.</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
        <div id="modal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="formModal" action="data-users.php" method="POST">
                  <input type="hidden" id="action" name="action">
                  <input type="hidden" id="id" name="id">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" id="password" name="password" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                      <option value="" hidden>Pilih Role</option>
                      <option value="admin">Admin</option>
                      <option value="member">Pengguna</option>
                    </select>
                  </div>
                  <!-- Button inside the form -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!--end::App Main-->
      <?php include('./footer.php'); ?>
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
      crossorigin="anonymous"
    ></script>
    <!-- SweetAlert2 CDN -->
    <script 
      src="https://cdn.jsdelivr.net/npm/sweetalert2@11"
    ></script>
    <script>
      // Fungsi untuk membuka modal
      function openModal(action, data = null) {
          document.getElementById("formModal").reset();
          var modal = new bootstrap.Modal(document.getElementById('modal'));
          modal.show();
          if (action === "edit" && data) {
              document.getElementById('modalLabel').textContent = "Edit Data";
              document.getElementById('action').value = "edit";
              document.getElementById('id').value = data.id;
              document.getElementById('username').value = data.username;
              document.getElementById('email').value = data.email;
              document.getElementById("email").readOnly = true;
              document.getElementById('password').value = data.password;
              document.getElementById('role').value = data.role;
          } else {
              document.getElementById('modalLabel').textContent = "Tambah Data";
              document.getElementById('action').value = "add";
              document.getElementById("email").readOnly = false;
          }
      }

      window.onload = function() {
          <?php if (isset($message)): ?>
              Swal.fire({
                  icon: 'success',
                  title: 'Sukses!',
                  text: "<?php echo $message; ?>",
              }).then(function() {
                  const url = new URL(window.location);
                  url.searchParams.delete('delete'); // Delete 'message' parameter
                  history.pushState({}, '', url);
                  window.location.href = window.location.href;
              });
          <?php elseif (isset($error)): ?>
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: "<?php echo $error; ?>",
              }).then(function() {
                  window.location.href = window.location.href;
              });
          <?php endif; ?>
      }
    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>