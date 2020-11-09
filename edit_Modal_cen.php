<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <form action="post" id="insert-form">
            <input type="hidden" id='id' name='id'>
            <label>ชื่อกิจกรรม</label>
            <input type="text" id='name' name='name' class='form-control'>
            <label>คะแนนกิจกรรม</label>
            <input type="text" id='score' name='score' class='form-control'>
            <label>ประเภทกิจกรรม</label>
            <select id="catname" name="catname"  class='form-control'>
            <option value="1">กิจกรรมส่วนกลาง</option>
              <option value="2">กิจกรรมบังคับคณะ</option>
              <option value="3">กิจกรรมเลือก</option>
          </select>
            <label>สถานะ</label>
            <select id="state" name="state"  class='form-control'>
              <option value="open">open</option>
              <option value="closed">closed</option>
          </select>
            <label>รายละเอียดกิจกรรม</label>
            <input type="text" id='de' name='de' class='form-control'><br>
            <input type="submit" id='insert' class='btn btn-success'>
        </form>
    </div>
    <!-- <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div> -->
  </div>
</div>
</div>