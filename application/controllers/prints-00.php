<?php
class Prints extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Report_model', 'report');
		$this->load->model('Service_model', 'service');
	}


    public function print_main_service($sv=''){
    	if(!isset($sv) || empty($sv)){
    		show_error('No service found.', 404);
    	}else{
            //get_main_service_detail($sv)
            $rs = $this->report->get_main_service_detail($sv);
            $items = $this->service->get_item($sv);

            $has_items = count($items) > 0 ? 'ตามเอกสารแนบท้าย' : '-';
            $slash_items = count($items) > 0 ? '/' : ' ';

            //cancel status
            $cancel = get_cancel_status();
            $slash_cancel = $cancel == $rs->service_status ? '/' : ' ';

            if($rs){
            	$this->load->library('pdf');
	            $this->pdf->setPrintHeader(false);
	            $this->pdf->setPrintFooter(false);
	            $this->pdf->setTopMargin(5);

	            // set document information
	            $this->pdf->SetSubject('AA Service');
	            $this->pdf->SetKeywords('AA Service');

	            // add a page
	            $this->pdf->AddPage();

	            // print a line using Cell()

	            /*select(array(
	            	's.*', 'p.product_serial','p.code as product_code',
	            	'p.name as product_name', 'o.name as owner_name',
	            	'u.fullname as request_name'))
		            	*/
	            $this->pdf->SetFont('freeserif', '', 12);
	            $html = '
	            <table border=0>
	            <tr>
	                <td><h4>โรงพยาบาลมหาสารคาม</h4></td>
	                <td><h1>ใบส่งซ่อม</h1></td>
	                <td>เลขที่: <b>'.$sv.'</b></td>
	            </tr>
	            <tr>
	                <td>หน่วยงาน: <b>'.$rs->owner_name.'</b> </td>
	                <td>โทรศัพท์ <b>-</b></td>
	                <td>วันที่  <b>'.to_thai_date($rs->date_serv).'</b></td>
	            </tr>
	            </table>
	            <hr>
	                <b>1. เรียน หน่วยงานซ่อมบำรุง</b>
	                &nbsp; &nbsp; &nbsp;  &nbsp; ด้วยฝ่าย/กลุ่มงาน มีความประสงค์ในการบริการซ่อมบำรุง ดังนี้  <br>
	                รายการที่ส่งซ่อม <b><u>'.$rs->product_name.'</u></b>  หมายเลขครุภัณฑ์ <b><u>'.$rs->product_code.'</u></b>
	                ยี่ห้อ <b><u> '.$rs->brand_name.' </u></b> รุ่น <b><u> '.$rs->model_name.' </u></b>  หมายเลขเครื่อง (Serial No.) <b><u> '.$rs->product_serial.' </u></b>
	                ซ่อมครั้งที่ _____ อาการเดิม _________________________ อาการแจ้งชำรุดครั้งนี้ <b><u> '.$rs->cause.' </u></b>
	                อายุการใช้งาน <b><u> '.$rs->age.' </u></b> ปี <br>
	                บริษัทผู้ขาย /  ที่อยู่ / เบอร์โทรศัพท์ <b><u> '.$rs->supplier_name.' </u></b>
	                <br>&nbsp; &nbsp; &nbsp;  &nbsp; จึงเรียนมาเพื่อโปรดพิจารณา
	                <div align="center">ผู้เสนอซ่อม .....<b>'.$rs->contact_name.'</b>..... (ตัวบรรจง)</div>
	                <hr>
	                    ระยะเวลาในการซ่อมประมาณ...........วัน <br>
	                    เหตุผล...................................................................................................................................................................... <br>
	                    ข้อเสนอแนะ..............................................................................................................................................................<br>
	                <hr>
	                <p><b>2. เรียน ผู้อำนวยการโรงพยาบาลมหาสารคาม</b></p>
	                &nbsp; &nbsp; &nbsp;  &nbsp; ด้วยงานซ่อมบำรุงได้ประเมิณและตรวจสอบงานแล้วปรากฎว่า <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] อาการที่ชำรุด ...............................................................................................................................................<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] สาเหตุที่ชำรุด ...............................................................................................................................................<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] ดำเนินการโดย .............................................................................................................................................<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [ '.$slash_items.' ] ซื้ออะไหล่เพิ่มเติม คือ  .........('. $has_items .')......................................<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [ '.$slash_cancel.' ] แทงจำหน่าย <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [  &nbsp; ] จัดจ้างให้พัสดุดำเนินการ <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] ส่งเครื่องมือให้บริษัทแล้ว เมื่อวันที่............................ <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่ที่หน่วยงานส่งซ่อม แผนก............................ <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่แผนก ช่างซ่อมบำรุง ช่างบริษัทยังไม่ได้ตรวจสอบ<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่ที่หน่วยงานส่งซ่อม ช่างบริษัทตรวจสอบแล้ว วันที่............................ <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;  ช่างผู้รับผิดชอบ................................................. (ตัวบรรจง)<br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;  หัวหน้างาน..................................................... <br>
	                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;&nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; (.................................................)
	                <hr>

	                <table border="0">
	                    <tr>
	                        <td>
	                        <b>3.</b> 3.1 ให้คณะกรรมการดังมีรายชื่อต่อไปนี้ทำการสืบราคา <br>
	                        1. .................................................................. <br>
	                        2. .................................................................. <br>
	                        3. .................................................................. <br>

	                        <b>ลงชื่อ.............................................................</b> <br>
	                        (.................................................................) <br>
	                        ประธานคณะกรรมการพิจารณางานซ่อมแซมและบำรุงรักษา
	                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
	                        3.3 เรียนผู้อำนวยการโรงพยาบาลมหาสารคามเพื่อโปรดพิจารณา <br>
	                        <b>ลงชื่อ.............................................................</b> <br>
	                        (.................................................................) <br>
	                        ประธานกรรมการพิจารณางานซ่อมแซมและบำรุงรักษา
	                        </td>
	                        <td>
	                        3.2 คณะกรรมการได้ทำการสืบราคาแล้วเห็นสมควร สั่งซื้อ/สั่งจ้าง ............................................................
	                        มาทำการซ่อมแซมงานดังกล่าวในราคา ......................... บาท <br>
	                        (.................................................................) <br>
	                        <b>ลงชื่อ.............................................................</b> <br>
	                        <b>ลงชื่อ.............................................................</b> <br>
	                        <b>ลงชื่อ.............................................................</b> <br>
	                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
	                        3.4 [ &nbsp; ] อนุมัติ &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; [ &nbsp; ] ไม่อนุมัติ <br>
	                        <b>ลงชื่อ.............................................................</b> <br>
	                        (.................................................................) <br>
	                        &nbsp; &nbsp; &nbsp;ผู้อำนวยการโรงพยาบาลมหาสารคาม  <br>
	                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
	                        </td>
	                    </tr>
	                </table>
	                <hr>
	                <p>วันงานแล้วเสร็จ................................&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
	                ผู้รับงาน........................................
	                		<i style="font-size: 13px;"> Print date: '. to_thai_date(date('Y-m-d')) . ' เวลา ' . date('H:i:s') . '</i></p>';

	            $this->pdf->WriteHTML($html, true, false, true, false,'');

                if(count($items) > 0)
                {
                    $this->pdf->AddPage();
                    $this->pdf->SetFont('freeserif', '', 11);
                    $html2 = '
                    <h3>รายการค่าใช้จ่าย/อุปกรณ์ [เลขที่ใบแจ้งซ่อม : '.$sv.']</h3>
                    <table style="border-width: 1px;">
                    <thead>
                    <tr style="background-color: gray;">
                    <th width="40" align="center"><strong>ลำดับ</strong></th>
                    <th width="240" align="center"><strong>ค่าใช้จ่าย/อุปกรณ์</strong></th>
                    <th width="70" align="right"><strong>ราคา</strong></th>
                    <th width="70" align="right"><strong>จำนวน</strong></th>
                    <th width="70" align="right"><strong>หน่วย</strong></th>
                    <th width="70" align="right"><strong>รวม</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    ';

                    $total = 0;
                    $i = 1;
                    foreach($items as $t)
                    {
                        $html2 .= '<tr>
                                    <td width="40" style="border-bottom-width: 1px;">'.$i.'</td>
                                    <td width="240" style="border-bottom-width: 1px;">'.$t->name.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->price, 2).'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->qty.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->unit.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->qty * $t->price, 2).'</td>
                                 </tr>';
                        $total += $t->price * $t->qty;
                        $i++;
                    }
                    $html2 .= '<tr><td colspan="5" align="right">รวมเป็นเงิน</td><td align="right"><strong>'.number_format($total, 2).'</strong></td></tr>';
                    $html2 .= '</tbody></table>';

                    $this->pdf->WriteHTML($html2, true, false, true, false,'');
                    $this->pdf->lastPage();
                }


                $rs_history = $this->service->get_history_main($rs->product_id);

                if(count($rs_history) > 0)
                {
                    $this->pdf->AddPage();
                    $this->pdf->SetFont('freeserif', '', 10);
                    $html3 = '
                    <h3>ประวัติการซ่อมครุภัณฑ์ : '.$rs->product_code.'</h3>
                    <table style="border-width: 1px;">
                    <thead>
                    <tr style="background-color: gray;">
                    <th width="40" align="center"><strong>ลำดับ</strong></th>
                    <th width="70" align="center"><strong>วันที่</strong></th>
                    <th width="90" align="center"><strong>เลขที่ใบแจ้งซ่อม</strong></th>
                    <th width="180" align="center"><strong>อาการ</strong></th>
                    <th width="100" align="center"><strong>ผู้แจ้ง</strong></th>
                    <th width="70" align="center"><strong>สถานะปัจจุบัน</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    ';

                    $i = 1;
                    foreach($rs_history as $r)
                    {
                        $html3 .= '<tr>
                                    <td width="40" style="border-bottom-width: 1px;">'.$i.'</td>
                                    <td width="70" style="border-bottom-width: 1px;">'.to_thai_date($r->date_serv).'</td>
                                    <td width="90" align="right" style="border-bottom-width: 1px;">'.$r->service_code.'</td>
                                    <td width="180" style="border-bottom-width: 1px;">'.$r->cause.'</td>
                                    <td width="100" align="right" style="border-bottom-width: 1px;">'.$r->contact_name.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.$r->status_name.'</td>
                                 </tr>';
                        $i++;
                    }

                    $html3 .= '</tbody></table>';

                    $this->pdf->WriteHTML($html3, true, false, true, false,'');
                    $this->pdf->lastPage();
                }

	            //Close and output PDF document
	            $this->pdf->Output($sv.'.pdf', 'I');
            }else{
            	show_error('No service found.', 404);
            }

    	}
    }

    public function print_other_service($sv=''){
    	if(!isset($sv) || empty($sv)){
    		show_error('No service found.', 404);
    	}else{
            //get_main_service_detail($sv)
            $rs = $this->report->get_other_service_detail($sv);
            $items = $this->service->get_item($sv);
            $has_items = count($items) > 0 ? 'ตามเอกสารแนบท้าย' : '-';
            $slash_items = count($items) > 0 ? '/' : ' ';

            //cancel status
            $cancel = get_cancel_status();
            $slash_cancel = $cancel == $rs->service_status ? '/' : ' ';

            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(5);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');

            // add a page
            $this->pdf->AddPage();

            // print a line using Cell()

            /*select(array(
            	's.*', 'p.product_serial','p.code as product_code',
            	'p.name as product_name', 'o.name as owner_name',
            	'u.fullname as request_name'))
	            	*/
            $this->pdf->SetFont('freeserif', '', 12);
            $html = '
            <table border=0>
            <tr>
                <td><h4>โรงพยาบาลมหาสารคาม</h4></td>
                <td><h1>ใบส่งซ่อม</h1></td>
                <td>เลขที่: <b>'.$sv.'</b></td>
            </tr>
            <tr>
                <td>หน่วยงาน: <b>'.$rs->owner_name.'</b> </td>
                <td>โทรศัพท์ <b>-</b></td>
                <td>วันที่  <b>'.to_thai_date($rs->date_serv).'</b></td>
            </tr>
            </table>
            <hr>
                <b>1. เรียน หน่วยงานซ่อมบำรุง</b>
                &nbsp; &nbsp; &nbsp;  &nbsp; ด้วยฝ่าย/กลุ่มงาน มีความประสงค์ในการบริการซ่อมบำรุง ดังนี้  <br>
                รายการที่ส่งซ่อม <b><u>'.$rs->product_name.'</u></b>  รายละเอียด <b><u>'.$rs->product_desc.'</u></b> หมายเลขครุภัณฑ์ <b><u> - </u></b>
                ยี่ห้อ <b><u> - </u></b> รุ่น <b><u> - </u></b>  หมายเลขเครื่อง (Serial No.) <b><u> - </u></b>
                ซ่อมครั้งที่ _____ อาการเดิม _____________________ อาการแจ้งชำรุดครั้งนี้ <b><u> '.$rs->cause.' </u></b>
                อายุการใช้งาน <b><u> - </u></b> ปี <br>
                บริษัทผู้ขาย /  ที่อยู่ / เบอร์โทรศัพท์ <b><u> - </u></b>
                <br>&nbsp; &nbsp; &nbsp;  &nbsp; จึงเรียนมาเพื่อโปรดพิจารณา
                <div align="center">ผู้เสนอซ่อม ..... <b>'.$rs->contact_name.'</b> ..... (ตัวบรรจง)</div>
                <hr>
                    ระยะเวลาในการซ่อมประมาณ...........วัน <br>
                    เหตุผล...................................................................................................................................................................... <br>
                    ข้อเสนอแนะ..............................................................................................................................................................<br>
                <hr>
                <p><b>2. เรียน ผู้อำนวยการโรงพยาบาลมหาสารคาม</b></p>
                &nbsp; &nbsp; &nbsp;  &nbsp; ด้วยงานซ่อมบำรุงได้ประเมิณและตรวจสอบงานแล้วปรากฎว่า <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] อาการที่ชำรุด ...............................................................................................................................................<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] สาเหตุที่ชำรุด ...............................................................................................................................................<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] ดำเนินการโดย .............................................................................................................................................<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [ '.$slash_items.' ] ซื้ออะไหล่เพิ่มเติม คือ  .........('. $has_items .')......................................<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] แทงจำหน่าย <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; [ '.$slash_cancel.' ] จัดจ้างให้พัสดุดำเนินการ <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] ส่งเครื่องมือให้บริษัทแล้ว เมื่อวันที่............................ <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่ที่หน่วยงานส่งซ่อม แผนก............................ <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่แผนก ช่างซ่อมบำรุง ช่างบริษัทยังไม่ได้ตรวจสอบ<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; [&nbsp; ] เครื่องอยู่ที่หน่วยงานส่งซ่อม ช่างบริษัทตรวจสอบแล้ว วันที่............................ <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;  ช่างผู้รับผิดชอบ................................................. (ตัวบรรจง)<br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;  หัวหน้างาน..................................................... <br>
                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;&nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; (.................................................)
                <hr>

                <table border="0">
                    <tr>
                        <td>
                        <b>3.</b> 3.1 ให้คณะกรรมการดังมีรายชื่อต่อไปนี้ทำการสืบราคา <br>
                        1. .................................................................. <br>
                        2. .................................................................. <br>
                        3. .................................................................. <br>

                        <b>ลงชื่อ.............................................................</b> <br>
                        (.................................................................) <br>
                        ประธานคณะกรรมการพิจารณางานซ่อมแซมและบำรุงรักษา
                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
                        3.3 เรียนผู้อำนวยการโรงพยาบาลมหาสารคามเพื่อโปรดพิจารณา <br>
                        <b>ลงชื่อ.............................................................</b> <br>
                        (.................................................................) <br>
                        ประธานกรรมการพิจารณางานซ่อมแซมและบำรุงรักษา
                        </td>
                        <td>
                        3.2 คณะกรรมการได้ทำการสืบราคาแล้วเห็นสมควร สั่งซื้อ/สั่งจ้าง ............................................................
                        มาทำการซ่อมแซมงานดังกล่าวในราคา ......................... บาท <br>
                        (.................................................................) <br>
                        <b>ลงชื่อ.............................................................</b> <br>
                        <b>ลงชื่อ.............................................................</b> <br>
                        <b>ลงชื่อ.............................................................</b> <br>
                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
                        3.4 [ &nbsp; ] อนุมัติ &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; [ &nbsp; ] ไม่อนุมัติ <br>
                        <b>ลงชื่อ.............................................................</b> <br>
                        (.................................................................) <br>
                        &nbsp; &nbsp; &nbsp;ผู้อำนวยการโรงพยาบาลมหาสารคาม  <br>
                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; .........../.........../................... <br>
                        </td>
                    </tr>
                </table>
                <hr>
                <p>วันงานแล้วเสร็จ................................&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                ผู้รับงาน........................................
                		<i style="font-size: 13px;"> Print date: '. to_thai_date(date('Y-m-d')) . ' เวลา ' . date('H:i:s') . '</i></p>';

            $this->pdf->WriteHTML($html, true, false, true, false,'');
            $this->pdf->AddPage();
            if(count($items) > 0)
            {


                $this->pdf->SetFont('freeserif', '', 11);
                $html2 = '
                    <h3>รายการค่าใช้จ่าย/อุปกรณ์ [เลขที่ใบแจ้งซ่อม : '.$sv.']</h3>
                    <table style="border-width: 1px;">
                    <thead>
                    <tr style="background-color: gray;">
                    <th width="40" align="center"><strong>ลำดับ</strong></th>
                    <th width="240" align="center"><strong>ค่าใช้จ่าย/อุปกรณ์</strong></th>
                    <th width="70" align="right"><strong>ราคา</strong></th>
                    <th width="70" align="right"><strong>จำนวน</strong></th>
                    <th width="70" align="right"><strong>หน่วย</strong></th>
                    <th width="70" align="right"><strong>รวม</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    ';

                $total = 0;
                $i = 1;
                foreach($items as $t)
                {
                    $html2 .= '<tr>
                                    <td width="40" style="border-bottom-width: 1px;">'.$i.'</td>
                                    <td width="240" style="border-bottom-width: 1px;">'.$t->name.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->price, 2).'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->qty.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->unit.'</td>
                                    <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->qty * $t->price, 2).'</td>
                                 </tr>';
                    $total += $t->price * $t->qty;
                    $i++;
                }
                $html2 .= '<tr><td colspan="5" align="right">รวมเป็นเงิน</td><td align="right"><strong>'.number_format($total, 2).'</strong></td></tr>';
                $html2 .= '</tbody></table>';
                $this->pdf->WriteHTML($html2, true, false, true, false,'');
                $this->pdf->lastPage();
            }

            //Close and output PDF document
            $this->pdf->Output($sv . '.pdf', 'I');
    	}
    }

    public function print_items()
    {
        $sv = $this->input->post('sv');
        if(empty($sv))
        {
            show_404('VN not found.');
        }
        else
        {
            $items = $this->service->get_item($sv);

            $this->load->library('pdf');
            $this->pdf->setPrintHeader(false);
            $this->pdf->setPrintFooter(false);
            $this->pdf->setTopMargin(5);

            // set document information
            $this->pdf->SetSubject('AA Service');
            $this->pdf->SetKeywords('AA Service');
            $this->pdf->SetFont('freeserif', '', 12);
            $this->pdf->AddPage();

            $this->pdf->SetFont('freeserif', '', 11);
            $html2 = '
                <h3>รายการค่าใช้จ่าย/อุปกรณ์ [เลขที่ใบแจ้งซ่อม : '.$sv.']</h3>
                <table style="border-width: 1px;">
                <thead>
                <tr style="background-color: gray;">
                <th width="40" align="center"><strong>ลำดับ</strong></th>
                <th width="240" align="center"><strong>ค่าใช้จ่าย/อุปกรณ์</strong></th>
                <th width="70" align="right"><strong>ราคา</strong></th>
                <th width="70" align="right"><strong>จำนวน</strong></th>
                <th width="70" align="right"><strong>หน่วย</strong></th>
                <th width="70" align="right"><strong>รวม</strong></th>
                </tr>
                </thead>
                <tbody>
                ';

            $total = 0;
            $i = 1;
            foreach($items as $t)
            {
                $html2 .= '<tr>
                                <td width="40" style="border-bottom-width: 1px;">'.$i.'</td>
                                <td width="240" style="border-bottom-width: 1px;">'.$t->name.'</td>
                                <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->price, 2).'</td>
                                <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->qty.'</td>
                                <td width="70" align="right" style="border-bottom-width: 1px;">'.$t->unit.'</td>
                                <td width="70" align="right" style="border-bottom-width: 1px;">'.number_format($t->qty * $t->price, 2).'</td>
                             </tr>';
                $total += $t->price * $t->qty;
                $i++;
            }
            $html2 .= '<tr><td colspan="5" align="right">รวมเป็นเงิน</td><td align="right"><strong>'.number_format($total, 2).'</strong></td></tr>';
            $html2 .= '</tbody></table>';
            $this->pdf->WriteHTML($html2, true, false, true, false,'');
            $this->pdf->lastPage();

            //Close and output PDF document
            $this->pdf->Output($sv . '.pdf', 'I');
        }
    }
}