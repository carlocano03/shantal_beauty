<style>
    .send_otp {
        font-size:11px; 
        font-weight:600; 
        text-decoration:underline;
        color: #0984e3;
        cursor: pointer;
    }
    .send_otp:hover {
        color: #74b9ff;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-key me-2"></i>OTP(6-Digit)</h5>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="otp_no" placeholder="6 Digit OTP No.">
                <span style="font-size:11px;">Didn't receive OTP? Please <span class="send_otp" title="Send OTP via email">resend.</span></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="button-next" id="verify_otp"><i class="fas fa-paper-plane me-1"></i>Submit</button>
            </div>
        </div>
    </div>
</div>