<!DOCTYPE html>
<html lang="en">
    <x-main-head />

    <x-main-header />

<body class="bg-body-secondary">




    <div class="container-fluid  my-3 p-3 bg-light rounded-3 shadow">
        <div class="row">
            <div class="col-12 mb-4">
                <h5 class="mb-0 text-primary-emphasis">Admission guide</h5>
                <small class="text-secondary">Follow these steps to apply for admission.</small>
            </div>
        </div>

        <div class="row bs-wizard text-center">
            <div class="col bs-wizard-step complete">
                <div class="bs-wizard-stepnum">Step 1</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a class="bs-wizard-dot"></a>
                <div class="bs-wizard-info">Create Account.</div>
            </div>

            <div class="col bs-wizard-step complete">
                <div class="bs-wizard-stepnum">Step 2</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a href="{{route('user.profile')}}" class="bs-wizard-dot"></a>
                <div class="bs-wizard-info">Complete profile upto 70%.</div>
            </div>

            <div class="col bs-wizard-step active">
                <div class="bs-wizard-stepnum">Step 3</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a href="{{route('admission.apply')}}" class="bs-wizard-dot"></a>
                <div class="bs-wizard-info">Apply for admission, then deposit fee.</div>
            </div>

            <div class="col bs-wizard-step active">
                <div class="bs-wizard-stepnum">Step 4</div>
                <div class="progress"><div class="progress-bar"></div></div>
                <a class="bs-wizard-dot"></a>
                <div class="bs-wizard-info">All done.</div>
            </div>
        </div>

    </div>

    <!-- Notifications Section -->
<div class="container mt-4 p-4 bg-primary text-white shadow rounded">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="fw-bold">📢 Notifications</h3>
        </div>
    </div>
</div>

<!-- Notifications Table -->
<div class="container p-3 bg-light rounded shadow-sm">
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">📅 Date</th>
                <th scope="col">🔔 Notification</th>
                <th scope="col" class="text-center">⚡ Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">2024-11-01</td>
                <td>
                    <i class="bi bi-envelope-fill text-primary me-2"></i>
                    New message from John Doe
                </td>
                <td class="text-center">
                    <a href="#" class="badge bg-success text-decoration-none">Details</a>
                </td>
            </tr>
            <tr>
                <td class="text-center">2024-11-02</td>
                <td>
                    <i class="bi bi-wrench-adjustable-circle text-warning me-2"></i>
                    System maintenance scheduled
                </td>
                <td class="text-center">
                    <span class="badge bg-warning text-dark">Pending</span>
                </td>
            </tr>
            <tr>
                <td class="text-center">2024-11-03</td>
                <td>
                    <i class="bi bi-key-fill text-danger me-2"></i>
                    Password change reminder
                </td>
                <td class="text-center">
                    <span class="badge bg-danger">Unread</span>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>





</body>

<x-main-footer />
</html>
