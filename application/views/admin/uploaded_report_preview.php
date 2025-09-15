<?php include('header.php'); ?>
<style>
  .spreadsheet-container .header-row {
    color: #6c757d;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 5px;


  }

  .modal-header {
    border-bottom: none;
  }


  .modal .spreadsheet-container {
    width: 100%;
  }

  .modal .spreadsheet-container {
    width: 100%;
  }

  .csv-preview {
    overflow-x: scroll;
    position: relative;
    width: 100%;
    /* height: 100%; */
  }

  .csv-preview .spreadsheet-container::before {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #00000038;

  }

  .spreadsheet-container {
    position: relative;
    background-color: white;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    /* margin-bottom: 30px; */
    width: max-content;
    height: 100%;
  }

  .spreadsheet-table {
    width: 100%;
    border-collapse: collapse;
  }

  .spreadsheet-table th,
  .spreadsheet-table td {
    border: 1px solid #dee2e6;
    padding: 5px;
    font-size: 14px;
  }

  .spreadsheet-table th {
    background-color: #f8f9fa;
    font-weight: 500;
    text-align: center;
    color: #495057;
  }

  .spreadsheet-table .row-header {
    background-color: #f8f9fa;
    color: #6c757d;
    text-align: center;
    width: 40px;
  }

  .spreadsheet-table .col-header {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 500;
    text-align: center;
  }

  .spreadsheet-table tr:first-child {
    background-color: #f8f9fa;
  }

  .responsive-spreadsheet {
    overflow-x: auto;
  }

  .empty-cell {
    background-color: white;
  }
</style>
<div class="main-content">
  <div class="sub-content">
    <div class="page-header">
      <h1 class="page-title">
        Report Preview

      </h1>
      <button class="btn btn-outline-secondary">
        <i class="bi bi-arrow-repeat"></i> Refresh
      </button>

      

    </div>





    <div class="row g-4">

      <div class="col-lg-4">
        <label for="bom-report">BOM Report</label>
        <div class="csv-preview">

          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="row-header">1</td>
                  <td class="milestone-cell"><strong>Level</strong></td>
                  <td><strong>Item</strong></td>
                  <td><strong>Description</strong></td>
                  <td><strong>Revision</strong></td>
                  <td><strong>Type</strong></td>
                  <td><strong>Status</strong></td>
                  <td><strong>UOM</strong></td>
                  <td><strong>Quantity</strong></td>
                </tr>
                <tr>
                  <td class="row-header">2</td>
                  <td>0</td>
                  <td>1060190311</td>
                  <td>PRECLEANER, METAL</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>101</td>
                </tr>
                <tr>
                  <td class="row-header">3</td>
                  <td>1</td>
                  <td>1060199</td>
                  <td>HOSE CLAMP, WORM</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">4</td>
                  <td>2</td>
                  <td>106012</td>
                  <td>PRECLEANER, POWDER COATED</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">5</td>
                  <td>3</td>
                  <td>10601159</td>
                  <td>PRECLEANER, WELDED</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">6</td>
                  <td>4</td>
                  <td>10156519</td>
                  <td>SHELL, METAL</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">7</td>
                  <td>5</td>
                  <td>8391452</td>
                  <td>M.S.SHEET</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Kg</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">8</td>
                  <td>4</td>
                  <td>10506039</td>
                  <td>COVER BOTTOM, METAL</td>
                  <td>3</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">9</td>
                  <td>4</td>
                  <td>10156669</td>
                  <td>PIPE EVACUATOR, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">10</td>
                  <td>4</td>
                  <td>10156639</td>
                  <td>FAN ASY</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
                <tr>
                  <td class="row-header">11</td>
                  <td>5</td>
                  <td>10156719</td>
                  <td>FAN, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">12</td>
                  <td>4</td>
                  <td>10156529</td>
                  <td>COVER TOP, METAL</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5010</td>
                </tr>
                <tr>
                  <td class="row-header">13</td>
                  <td>4</td>
                  <td>10601119</td>
                  <td>PIPE, METAL</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6010</td>
                </tr>
                <tr>
                  <td class="row-header">14</td>
                  <td>2</td>
                  <td>10107059</td>
                  <td>EJECTOR VALVE</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">15</td>
                  <td>2</td>
                  <td>10300929</td>
                  <td>LABEL, DATECODE</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4020</td>
                </tr>
                <tr>
                  <td class="row-header">16</td>
                  <td>2</td>
                  <td>10120389</td>
                  <td>LABEL, ARROW</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5020</td>
                </tr>
                <tr>
                  <td class="row-header">17</td>
                  <td>2</td>
                  <td>10129599</td>
                  <td>HOLOGRAM</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6020</td>
                </tr>
                <tr>
                  <td class="row-header">18</td>
                  <td>1</td>
                  <td>10601989</td>
                  <td>CARTON, CORRUGATED</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">19</td>
                  <td>1</td>
                  <td>10601149</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">20</td>
                  <td>1</td>
                  <td>10601139</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <button type="button" class="btn btn-dark w-100 my-3 custom-modal" data-bs-toggle="modal" data-bs-target="#exampleModal-1">
          Preview BOM Report
        </button>
      </div>
      <div class="col-lg-4">
        <label for="bom-report">Order Report</label>
        <div class="csv-preview">
          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="row-header">1</td>
                  <td class="milestone-cell"><strong>Level</strong></td>
                  <td><strong>Item</strong></td>
                  <td><strong>Description</strong></td>
                  <td><strong>Revision</strong></td>
                  <td><strong>Type</strong></td>
                  <td><strong>Status</strong></td>
                  <td><strong>UOM</strong></td>
                  <td><strong>Quantity</strong></td>
                </tr>
                <tr>
                  <td class="row-header">2</td>
                  <td>0</td>
                  <td>1060190311</td>
                  <td>PRECLEANER, METAL</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>101</td>
                </tr>
                <tr>
                  <td class="row-header">3</td>
                  <td>1</td>
                  <td>1060199</td>
                  <td>HOSE CLAMP, WORM</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">4</td>
                  <td>2</td>
                  <td>106012</td>
                  <td>PRECLEANER, POWDER COATED</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">5</td>
                  <td>3</td>
                  <td>10601159</td>
                  <td>PRECLEANER, WELDED</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">6</td>
                  <td>4</td>
                  <td>10156519</td>
                  <td>SHELL, METAL</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">7</td>
                  <td>5</td>
                  <td>8391452</td>
                  <td>M.S.SHEET</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Kg</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">8</td>
                  <td>4</td>
                  <td>10506039</td>
                  <td>COVER BOTTOM, METAL</td>
                  <td>3</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">9</td>
                  <td>4</td>
                  <td>10156669</td>
                  <td>PIPE EVACUATOR, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">10</td>
                  <td>4</td>
                  <td>10156639</td>
                  <td>FAN ASY</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
                <tr>
                  <td class="row-header">11</td>
                  <td>5</td>
                  <td>10156719</td>
                  <td>FAN, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">12</td>
                  <td>4</td>
                  <td>10156529</td>
                  <td>COVER TOP, METAL</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5010</td>
                </tr>
                <tr>
                  <td class="row-header">13</td>
                  <td>4</td>
                  <td>10601119</td>
                  <td>PIPE, METAL</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6010</td>
                </tr>
                <tr>
                  <td class="row-header">14</td>
                  <td>2</td>
                  <td>10107059</td>
                  <td>EJECTOR VALVE</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">15</td>
                  <td>2</td>
                  <td>10300929</td>
                  <td>LABEL, DATECODE</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4020</td>
                </tr>
                <tr>
                  <td class="row-header">16</td>
                  <td>2</td>
                  <td>10120389</td>
                  <td>LABEL, ARROW</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5020</td>
                </tr>
                <tr>
                  <td class="row-header">17</td>
                  <td>2</td>
                  <td>10129599</td>
                  <td>HOLOGRAM</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6020</td>
                </tr>
                <tr>
                  <td class="row-header">18</td>
                  <td>1</td>
                  <td>10601989</td>
                  <td>CARTON, CORRUGATED</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">19</td>
                  <td>1</td>
                  <td>10601149</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">20</td>
                  <td>1</td>
                  <td>10601139</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        <button type="button" class="btn btn-dark w-100 my-3 custom-modal" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
          Preview Order Report
        </button>
      </div>
      <div class="col-lg-4">
        <label for="bom-report">Inventory Report</label>
        <div class="csv-preview">

          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th class="col-header text-center">Row</th>
                  <th class="col-header text-left">Item</th>
                  <th class="col-header text-left">Description</th>
                  <th class="col-header">Intransit</th>
                  <th class="col-header">DOM.STEEL</th>
                  <th class="col-header">Receiving</th>
                  <th class="col-header">REJECT_RM</th>
                  <th class="col-header">Scrap</th>
                  <th class="col-header">PROCESS REJ.</th>
                  <th class="col-header">SCRAP</th>
                  <th class="col-header">SHOP.RM</th>
                  <th class="col-header">SHOP.SAOS</th>
                  <th class="col-header">P</th>
                  <th class="col-header">Total Quantity</th>
                  <th class="col-header">Unit Cost</th>
                  <th class="col-header">Total Cost</th>
                  <th class="col-header">MAX.Quantity</th>
                  <th class="col-header">On Hand</th>
                  <th class="col-header text-left">Production Line</th>
                  <th class="col-header text-left">Trading Flag</th>
                </tr>
              </thead>
              <tbody>
                <tr class="highlight-row">
                  <td class="text-center">1</td>
                  <td class="text-left">101023999</td>
                  <td class="text-left">CIRCLIP</td>
                  <td>0</td>
                  <td>243</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>263</td>
                  <td>5.4693</td>
                  <td>1438.43</td>
                  <td>59</td>
                  <td>150</td>
                  <td class="text-left">263</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">2</td>
                  <td class="text-left">101042799</td>
                  <td class="text-left">TAPE, BOPP</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>100</td>
                  <td>9802.36</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>9902.36</td>
                  <td>0.5221</td>
                  <td>5170.62</td>
                  <td>233</td>
                  <td>12029</td>
                  <td class="text-left">9802.36</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">3</td>
                  <td class="text-left">101046199</td>
                  <td class="text-left">ADHESIVE, LOCTITE</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>10.00</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>2490.64</td>
                  <td>6968.84</td>
                  <td>3582</td>
                  <td>2026.15</td>
                  <td>7211</td>
                  <td class="text-left">2490.64</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">4</td>
                  <td class="text-left">101067199</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>4556</td>
                  <td>1.3984</td>
                  <td>6371.29</td>
                  <td>2644</td>
                  <td>7414</td>
                  <td class="text-left">4556</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">5</td>
                  <td class="text-left">101067299</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>564</td>
                  <td>1.9571</td>
                  <td>1103.75</td>
                  <td>823</td>
                  <td>65</td>
                  <td class="text-left">64</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">6</td>
                  <td class="text-left">101067399</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>1408</td>
                  <td>1.8026</td>
                  <td>2538.02</td>
                  <td>1561</td>
                  <td>590</td>
                  <td class="text-left">1408</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">7</td>
                  <td class="text-left">101067499</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>438</td>
                  <td>2.9543</td>
                  <td>1293.97</td>
                  <td>588</td>
                  <td>400</td>
                  <td class="text-left">438</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">8</td>
                  <td class="text-left">101068299</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>18</td>
                  <td>5.5826</td>
                  <td>100.49</td>
                  <td>68</td>
                  <td>0</td>
                  <td class="text-left">18</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">9</td>
                  <td class="text-left">101068799</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>2471</td>
                  <td>0.7208</td>
                  <td>1781.05</td>
                  <td>738</td>
                  <td>1643</td>
                  <td class="text-left">2471</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">10</td>
                  <td class="text-left">101068999</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>20</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>1125</td>
                  <td>0.2878</td>
                  <td>1573.78</td>
                  <td>667</td>
                  <td>0</td>
                  <td class="text-left">1125</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">11</td>
                  <td class="text-left">101069999</td>
                  <td class="text-left">BAG, POLY</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>1047</td>
                  <td>0.3296</td>
                  <td>345.10</td>
                  <td>167</td>
                  <td>1124</td>
                  <td class="text-left">1047</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">12</td>
                  <td class="text-left">101070500</td>
                  <td class="text-left">EJECTOR VALVE</td>
                  <td>2</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>2</td>
                  <td>0.8881</td>
                  <td>3417.76</td>
                  <td>26</td>
                  <td>0</td>
                  <td class="text-left">LPK LINE</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">13</td>
                  <td class="text-left">101070599</td>
                  <td class="text-left">EJECTOR VALVE</td>
                  <td>0</td>
                  <td>0</td>
                  <td>100</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>200</td>
                  <td>2235</td>
                  <td>0</td>
                  <td>2535</td>
                  <td>14.0680</td>
                  <td>31289.20</td>
                  <td>1352</td>
                  <td>2002</td>
                  <td class="text-left">2235</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">14</td>
                  <td class="text-left">1010705V7</td>
                  <td class="text-left">EJECTOR VALVE</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>4</td>
                  <td>16.0328</td>
                  <td>64.13</td>
                  <td>13</td>
                  <td>20</td>
                  <td class="text-left">LPK LINE</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">15</td>
                  <td class="text-left">1010705W2</td>
                  <td class="text-left">EJECTOR VALVE</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>5</td>
                  <td>18.0909</td>
                  <td>90.45</td>
                  <td>43</td>
                  <td>0</td>
                  <td class="text-left">LPK LINE</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">16</td>
                  <td class="text-left">101095399</td>
                  <td class="text-left">GASKET, RECT</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>2178.42</td>
                  <td>8.6314</td>
                  <td>2136.44</td>
                  <td>270</td>
                  <td>2178.42</td>
                  <td class="text-left"></td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">17</td>
                  <td class="text-left">101101731</td>
                  <td class="text-left">BOLT, HEX HEAD</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>20</td>
                  <td>11.7837</td>
                  <td>235.67</td>
                  <td>42</td>
                  <td>0</td>
                  <td class="text-left">LPK LINE</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">18</td>
                  <td class="text-left">101101799</td>
                  <td class="text-left">BOLT, HEX HEAD</td>
                  <td>0</td>
                  <td>3872</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>670</td>
                  <td>10.8254</td>
                  <td>7189.89</td>
                  <td>14</td>
                  <td>50</td>
                  <td class="text-left">670</td>
                  <td class="text-left"></td>
                </tr>
                <tr class="highlight-row">
                  <td class="text-center">19</td>
                  <td class="text-left">101105399</td>
                  <td class="text-left">GASKET, ORING</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>493</td>
                  <td>1.6416</td>
                  <td>550.44</td>
                  <td>84</td>
                  <td>0</td>
                  <td class="text-left">49</td>
                  <td class="text-left"></td>
                </tr>


              </tbody>
            </table>
          </div>

        </div>
        <button type="button" class="btn btn-dark w-100 my-3 custom-modal" data-bs-toggle="modal" data-bs-target="#exampleModal-3">
          Preview Inventory Report
        </button>
      </div>



      <!-- <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button id="submit" type="submit" class="btn btn-dark btn-sm mt-4">Submit</button>
      </div> -->

    </div>
  </div>


</div>
<div class="modal fade" id="exampleModal-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">BOM Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="responsive-spreadsheet">
          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="row-header">1</td>
                  <td class="milestone-cell"><strong>Level</strong></td>
                  <td><strong>Item</strong></td>
                  <td><strong>Description</strong></td>
                  <td><strong>Revision</strong></td>
                  <td><strong>Type</strong></td>
                  <td><strong>Status</strong></td>
                  <td><strong>UOM</strong></td>
                  <td><strong>Quantity</strong></td>
                </tr>
                <tr>
                  <td class="row-header">2</td>
                  <td>0</td>
                  <td>1060190311</td>
                  <td>PRECLEANER, METAL</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>101</td>
                </tr>
                <tr>
                  <td class="row-header">3</td>
                  <td>1</td>
                  <td>1060199</td>
                  <td>HOSE CLAMP, WORM</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">4</td>
                  <td>2</td>
                  <td>106012</td>
                  <td>PRECLEANER, POWDER COATED</td>
                  <td>0</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">5</td>
                  <td>3</td>
                  <td>10601159</td>
                  <td>PRECLEANER, WELDED</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">6</td>
                  <td>4</td>
                  <td>10156519</td>
                  <td>SHELL, METAL</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">7</td>
                  <td>5</td>
                  <td>8391452</td>
                  <td>M.S.SHEET</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Kg</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">8</td>
                  <td>4</td>
                  <td>10506039</td>
                  <td>COVER BOTTOM, METAL</td>
                  <td>3</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">9</td>
                  <td>4</td>
                  <td>10156669</td>
                  <td>PIPE EVACUATOR, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">10</td>
                  <td>4</td>
                  <td>10156639</td>
                  <td>FAN ASY</td>
                  <td>1</td>
                  <td>Subassembly</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
                <tr>
                  <td class="row-header">11</td>
                  <td>5</td>
                  <td>10156719</td>
                  <td>FAN, METAL</td>
                  <td>1</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>1010</td>
                </tr>
                <tr>
                  <td class="row-header">12</td>
                  <td>4</td>
                  <td>10156529</td>
                  <td>COVER TOP, METAL</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5010</td>
                </tr>
                <tr>
                  <td class="row-header">13</td>
                  <td>4</td>
                  <td>10601119</td>
                  <td>PIPE, METAL</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6010</td>
                </tr>
                <tr>
                  <td class="row-header">14</td>
                  <td>2</td>
                  <td>10107059</td>
                  <td>EJECTOR VALVE</td>
                  <td>2</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">15</td>
                  <td>2</td>
                  <td>10300929</td>
                  <td>LABEL, DATECODE</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4020</td>
                </tr>
                <tr>
                  <td class="row-header">16</td>
                  <td>2</td>
                  <td>10120389</td>
                  <td>LABEL, ARROW</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>5020</td>
                </tr>
                <tr>
                  <td class="row-header">17</td>
                  <td>2</td>
                  <td>10129599</td>
                  <td>HOLOGRAM</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>6020</td>
                </tr>
                <tr>
                  <td class="row-header">18</td>
                  <td>1</td>
                  <td>10601989</td>
                  <td>CARTON, CORRUGATED</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>2010</td>
                </tr>
                <tr>
                  <td class="row-header">19</td>
                  <td>1</td>
                  <td>10601149</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>3010</td>
                </tr>
                <tr>
                  <td class="row-header">20</td>
                  <td>1</td>
                  <td>10601139</td>
                  <td>PACKAGING, INSERT</td>
                  <td>0</td>
                  <td>Min-Max - Purchase</td>
                  <td>Active</td>
                  <td>Nos</td>
                  <td>4010</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark w-100 my-3 full-report"> View Full Report </button>

      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="responsive-spreadsheet">
          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="row-header">1</td>
                  <td class="milestone-cell"><strong>Project steps/Milestones</strong></td>
                  <td><strong>Start date</strong></td>
                  <td><strong>End date</strong></td>
                  <td><strong>Expected start date</strong></td>
                  <td><strong>Expected end date</strong></td>
                  <td><strong>Actual start date</strong></td>
                  <td><strong>Actual end date</strong></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">2</td>
                  <td>Project kickoff meeting</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">3</td>
                  <td>Introduction with Various process owners</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">4</td>
                  <td>Receipts of books of account</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">5</td>
                  <td>Trial balance analytical review</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">6</td>
                  <td>Audit methodology prepreation</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">7</td>
                  <td>Initial requirment raisng</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <!-- Empty rows -->
                <tr>
                  <td class="row-header">8</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">9</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">10</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">11</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">12</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">13</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">14</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">15</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">16</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">17</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">18</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">19</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">20</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer border-none">
        <button type="button" class="btn btn-dark w-100 my-3 full-report"> View Full Report </button>

      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal-3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Inventory Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="responsive-spreadsheet">
          <div class="spreadsheet-container">
            <table class="spreadsheet-table">
              <thead>
                <tr>
                  <th></th>
                  <th class="col-header">A</th>
                  <th class="col-header">B</th>
                  <th class="col-header">C</th>
                  <th class="col-header">D</th>
                  <th class="col-header">E</th>
                  <th class="col-header">F</th>
                  <th class="col-header">G</th>
                  <th class="col-header">H</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="row-header">1</td>
                  <td class="milestone-cell"><strong>Project steps/Milestones</strong></td>
                  <td><strong>Start date</strong></td>
                  <td><strong>End date</strong></td>
                  <td><strong>Expected start date</strong></td>
                  <td><strong>Expected end date</strong></td>
                  <td><strong>Actual start date</strong></td>
                  <td><strong>Actual end date</strong></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">2</td>
                  <td>Project kickoff meeting</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">3</td>
                  <td>Introduction with Various process owners</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">4</td>
                  <td>Receipts of books of account</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">5</td>
                  <td>Trial balance analytical review</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">6</td>
                  <td>Audit methodology prepreation</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">7</td>
                  <td>Initial requirment raisng</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <!-- Empty rows -->
                <tr>
                  <td class="row-header">8</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">9</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">10</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">11</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">12</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">13</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">14</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">15</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">16</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">17</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">18</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">19</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
                <tr>
                  <td class="row-header">20</td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                  <td class="empty-cell"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark w-100 my-3 full-report"> View Full Report </button>

      </div>

    </div>
  </div>
</div>
<?php include('footer.php'); ?>
<script>
  $(document).ready(function() {
    $('#master').addClass('active');

    $('.full-report').click(function() {
      alert("Redirecting to full report preview...");
      setTimeout(function() {
        window.location.href = "<?=base_url()?>report-full-preview";
      }, 500); // Delays the redirection slightly
    });


    $('.submit-btn').click(function() {
    
        window.location.href = "<?=base_url()?>generated-report";
     
    });

  });
</script>

<script>
  function showFileName(input, targetId) {
    const fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
    document.getElementById(targetId).textContent = fileName;
  }
</script>
