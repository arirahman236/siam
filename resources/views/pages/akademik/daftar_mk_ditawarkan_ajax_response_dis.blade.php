<table class="table sortableCAjax no-margin " width="100%" style="font-size:10px;margin-top:-20px; ">
	<thead>
           <tr bgcolor="#FFFFFF" align="center">
               <th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>No.
				</th>
                <th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Hari
				</th>
                <th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Jam
				</th>
                <th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Kode
				</th><th scope="col" width="10%">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Nama
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Kelas
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Ruang
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>SKS
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Smt.
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>W/P
				</th><th scope="col" width="8%">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Prasyarat
				</th><th scope="col">
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Pst.
				</th>
                <th scope="col" width="5%" >
							<span class="column-sort">
								<a href="#" title="Sort up" class="sort-up"></a>
								<a href="#" title="Sort down" class="sort-down"></a>
							</span>Maks.
				</th>
            </tr>
            </thead>
            <tbody>
            <?php if($getDataMkDitawarkan): ?>

            <?php $seq_number =1; ?>
            <?php foreach($getDataMkDitawarkan as $mk): ?>
            <?php $jumlah_peminat = $this->akad_model->jumlahPeminatMk($mk->KODE_PRODI,$mk->KODE_MK,$mk->KELAS,$mk->TAHUN); ?>
            <?php $maks_kapasitas_kelas = $this->akad_model->kapasitasKelasMk($mk->KODE_PRODI,$mk->KODE_MK,$mk->KELAS,$mk->TAHUN); ?>
            <?php $cek_prasyarat_mk = $this->krs_library->check_prasyarat_mk($this->session->userdata('siam_user'),$mk->KODE_PRASYARAT1, $mk->KODE_PRASYARAT2); ?>
            <?php $mk_prasyarat1 = $this->akad_model->getKodeMkByNoMk($mk->KODE_PRASYARAT1);?>
            <?php $mk_prasyarat2 = $this->akad_model->getKodeMkByNoMk($mk->KODE_PRASYARAT2);?>

            <?php $has_entried = 0; ?>
            <?php if($krs): ?>
            <?php foreach($krs as $krsValue):?>
               <?php if ($mk->KODE_MK == $krsValue->KODE_MATAKULIAH): ?>
                      <?php $has_entried = 1;?>
               <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>



            <tr style="color:#000" align="center">
              <td height="28">
               <?php
                            if( ($jumlah_peminat < $maks_kapasitas_kelas->KAPASITAS) && ($cek_prasyarat_mk > 0) && ($has_entried == 0) )
                            {
                              $btn = "btn btn-info";
                            }
                            else
                            {
                              $btn = "btn btn-success";
                            }
                            ?>
                           <button class="button_submit <?php echo $btn; ?>" type="button" value="<?php echo $mk->ID_MK_TERSEDIA ?>" name="mk" <?php if( ($jumlah_peminat < $maks_kapasitas_kelas->KAPASITAS) && ($cek_prasyarat_mk > 0) && ($has_entried == 0) ): ?> <?php else: ?> disabled="DISABLED" <?php endif; ?>  >Pilih</button>
               <!--<input type="radio" name="mk" value="<?php echo $mk->ID_MK_TERSEDIA;?>" />-->
              </td>
              <td align="left" style="padding-left:10px"><?php echo ucwords(strtolower($mk->HARI)); ?></td>
              <td><?php echo $mk->MULAI.' - '.$mk->SELESAI; ?></td>
              <td><?php echo strtoupper($mk->KODE_MK); ?></td>
              <td align="left" style="padding-left:10px"><?php echo $mk->NAMA_MK; ?></td>
              <td><?php echo kelas_to_huruf((int)$mk->KELAS) ?></td>
              <td><?php echo $mk->RUANG ?></td>
              <td><?php echo $mk->SKS ?></td>
              <td><?php echo $mk->SEMESTER_MK; ?></td>
              <td><?php echo $mk->SIFAT ?></td>
              <td><?php if($mk->KODE_PRASYARAT1):?>
              <?php if($mk_prasyarat1->NO_MATAKULIAH!=0) echo $mk_prasyarat1->KODE_MATAKULIAH ?>
              <?php endif; ?> <?php if($mk->KODE_PRASYARAT1 && $mk->KODE_PRASYARAT2):?><?php echo ','?><?php endif;?>
               <?php if($mk->KODE_PRASYARAT2):?>
               <?php if($mk_prasyarat2->NO_MATAKULIAH!=0) echo $mk_prasyarat2->KODE_MATAKULIAH ?><?php endif; ?></td>
              <td><?php echo $jumlah_peminat ?></td>
              <td><?php echo $maks_kapasitas_kelas->KAPASITAS ?></td>
            </tr>

            <?php $seq_number++; ?>
            <?php endforeach; ?>
            <?php endif; ?>
      </tbody>
</table>
<script>
	  $('.sortableCAjax').each(function(i)
			{

				var table = $(this),
					oTable = table.dataTable({

						aoColumns: [
							{ bSortable: false },
							{ sType: 'string' },
						    { bSortable: false },
							{ sType: 'string' },
                            { sType: 'string' },
                            { bSortable: false },
                            { bSortable: false },
                            { bSortable: false },
                            { sType: 'string' },
                            { bSortable: false },
                            { bSortable: false },
                            { bSortable: false },
                            { bSortable: false }
						],


						sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',


						fnDrawCallback: function()
						{
							this.parent().applyTemplateSetup();
						},
						fnInitComplete: function()
						{
							this.parent().applyTemplateSetup();
						}
					});


				table.find('thead .sort-up').click(function(event)
				{

					event.preventDefault();


					var column = $(this).closest('th'),
						columnIndex = column.parent().children().index(column.get(0));

					oTable.fnSort([[columnIndex, 'asc']]);

					return false;
				});
				table.find('thead .sort-down').click(function(event)
				{

					event.preventDefault();


					var column = $(this).closest('th'),
						columnIndex = column.parent().children().index(column.get(0));


					oTable.fnSort([[columnIndex, 'desc']]);

					return false;
				});
			});
	  
    </script>
    | Kuota SKS<br /><?php echo ( $this->gpa_com->maxSksDiambilByIpsKemarin($kontrol->SEMESTER,$this->session->userdata('siam_user')) - $jumlah_sks_sudah_diambil )?> sks