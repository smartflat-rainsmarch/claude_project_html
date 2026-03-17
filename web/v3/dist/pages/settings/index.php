<!-- SmartFlat CMS v3 - Settings Page -->
<div class="page-header">
    <h1 class="page-title">설정</h1>
    <p class="page-description">시스템 설정을 관리합니다</p>
</div>

<!-- General Settings -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">일반 설정</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">언어</label>
            <select class="form-control form-select" style="max-width: 300px;">
                <option value="ko" selected>한국어</option>
                <option value="en">English</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">시간대</label>
            <select class="form-control form-select" style="max-width: 300px;">
                <option value="Asia/Seoul" selected>Asia/Seoul (KST)</option>
                <option value="UTC">UTC</option>
            </select>
        </div>
    </div>
</div>

<!-- Notification Settings -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">알림 설정</h3>
    </div>
    <div class="card-body">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="notify-deploy" checked>
            <label class="form-check-label" for="notify-deploy">배포 완료 알림</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="notify-error" checked>
            <label class="form-check-label" for="notify-error">오류 알림</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="notify-device">
            <label class="form-check-label" for="notify-device">기기 연결 상태 알림</label>
        </div>
    </div>
</div>

<!-- System Info -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">시스템 정보</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 200px; color: var(--text-gray);">버전</td>
                    <td><?php echo CMS_VERSION; ?></td>
                </tr>
                <tr>
                    <td style="color: var(--text-gray);">PHP 버전</td>
                    <td><?php echo phpversion(); ?></td>
                </tr>
                <tr>
                    <td style="color: var(--text-gray);">서버 시간</td>
                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
