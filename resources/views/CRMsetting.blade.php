<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Setting.css') }}">
</head>
<body>
  <div class="sidebar-and-setting-container">

   @extends('layout.app')
   
   @section('title', 'Main Dashboard')
   
   @section('content')   
    <div class="container">
        <div class="sidebar">
            <h2>Settings</h2>
            <ul class="sidebar-menu" id="sidebar-menu">
                <li class="active" data-section="general"><a href="#"><i class="fas fa-cog"></i> General Settings</a></li>
                <li data-section="company"><a href="#"><i class="fas fa-building"></i> Company Settings</a></li>
                <li data-section="logo"><a href="#"><i class="fas fa-image"></i> Company Logo</a></li>
                <li data-section="currency"><a href="#"><i class="fas fa-money-bill-wave"></i> Currency Settings</a></li>
                <li data-section="pdf"><a href="#"><i class="fas fa-file-pdf"></i> PDF Settings</a></li>
                <li data-section="finance"><a href="#"><i class="fas fa-chart-line"></i> Finance Settings</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div id="general-settings-section" class="content-section active">
                <h1>General Settings</h1>
                <div class="section-card">
                    <h3>App Settings</h3>
                    <p>Update Your App Configuration</p>
                    <div class="form-group"><label for="language"><span>*</span> Language:</label><select id="language" class="styled-select"><option value="en-US">us English</option><option value="es-ES">es Spanish</option></select></div>
                    <div class="form-group"><label for="country"><span>*</span> Country:</label><select id="country" class="styled-select"><option value="IN">IN India</option><option value="US">US United States</option></select></div>
                    <div class="form-group"><label for="dateFormat"><span>*</span> Date Format:</label><select id="dateFormat" class="styled-select"><option value="DD/MM/YYYY">DD/MM/YYYY</option><option value="MM/DD/YYYY">MM/DD/YYYY</option></select></div>
                    <div class="form-group"><label for="email"><span>*</span> Email:</label><input type="email" id="email"></div>
                </div>
                <button class="save-button">Save</button>
            </div>

            <div id="company-settings-section" class="content-section">
                <h1>Company Settings</h1>
               <form action="{{ route('setting.company.update') }}" method="POST">
    @csrf

    <div class="section-card">
        <h3>Company Settings</h3> 
        <p>Update Your Company Informations</p>

        <div class="form-group">
            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" name="Comp_Name" value="{{ $company->Comp_Name ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyAddress">Company Address:</label>
            <input type="text" id="companyAddress" name="Comp_Address" value="{{ $company->Comp_Address ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyState">Company State:</label>
            <input type="text" id="companyState" name="Comp_State" value="{{ $company->Comp_State ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyCountry">Company Country:</label>
            <input type="text" id="companyCountry" name="Comp_Country" value="{{ $company->Comp_Country ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyEmail">Company Email:</label>
            <input type="email" id="companyEmail" name="Comp_Email" value="{{ $company->Comp_Email ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyPhone">Company Phone:</label>
            <input type="tel" id="companyPhone" name="Comp_Phone" value="{{ $company->Comp_Phone ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyWebsite">Company Website:</label>
            <input type="text" id="companyWebsite" name="Comp_Website" value="{{ $company->Comp_Website ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyTax">Company Tax Number:</label>
            <input type="text" id="companyTax" name="Comp_Tax_Number" value="{{ $company->Comp_Tax_Number ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyVat">Company Vat Number:</label>
            <input type="text" id="companyVat" name="Comp_Vat_Number" value="{{ $company->Comp_Vat_Number ?? '' }}">
        </div>

        <div class="form-group">
            <label for="companyReg">Company Reg Number:</label>
            <input type="text" id="companyReg" name="Comp_Reg_Number" value="{{ $company->Comp_Reg_Number ?? '' }}">
        </div>

    </div>

    <button type="submit" class="save-button">Save</button>
</form>

            </div>

            <div id="logo-settings-section" class="content-section ">
                <h1>General Settings</h1> 
                <div class="section-card">
                    <h3>Company Logo</h3>
                    <p>Update Company Logo</p>
                    <div class="form-group">
                        <label for="logo-upload">Logo:</label>
                        <div class="file-upload-container">
                            <input type="file" id="logo-upload" accept="image/*">
                            <label for="logo-upload" class="upload-button">
                                <i class="fas fa-upload"></i> Click To Upload
                            </label>
                        </div>
                    </div>
                </div>
                <button class="save-button">Save</button>
            </div>

            <div id="currency-settings-section" class="content-section">
                <h1>Money Format Settings</h1>
                <div class="section-card">
                    <h3>Default Currency</h3>
                    <p>Select Default Currency</p>
                    <div class="form-group">
                        <label for="currencySelect"><span>*</span> Currency :</label>
                        <select id="currencySelect" class="styled-select">
                            <option value="USD" selected>$ (US Dollar)</option>
                            <option value="EUR">€ (Euro)</option>
                            <option value="GBP">£ (British Pound)</option>
                            <option value="INR">₹ (Indian Rupee)</option>
                        </select>
                    </div>
                </div>
                <button class="save-button">Save</button>
            </div>

            <div id="pdf-settings-section" class="content-section">
                <h1>Pdf Settings</h1>
                <div class="section-card">
                    <h3>App Settings</h3>
                    <p>Update Your App Configuration</p>
                    
                    <div class="form-group">
                        <label for="invoiceFooter">Invoice Pdf Footer:</label>
                        <textarea id="invoiceFooter">Invoice was created on a computer and is valid without the signature and seal.</textarea>
                    </div>

                    <div class="form-group">
                        <label for="quoteFooter">Quote Pdf Footer:</label>
                        <textarea id="quoteFooter">Quote was created on a computer and is valid without the signature and seal.</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="offerFooter">Offer Pdf Footer:</label>
                        <textarea id="offerFooter">Offer was created on a computer and is valid without the signature and seal.</textarea>
                    </div>
                </div>
                <button class="save-button">Save</button>
            </div>
            
            <div id="finance-settings-section" class="content-section">
                <h1>Finance Settings</h1>
                <div class="section-card">
                    <h3>Finance Settings</h3>
                    <p>Update Company Finance Settings</p>
                    
                    <div class="form-group">
                        <label for="lastInvoiceNum"><span>*</span> Last Invoice Number:</label>
                        <input type="number" id="lastInvoiceNum" value="0">
                    </div>

                    <div class="form-group">
                        <label for="lastQuoteNum"><span>*</span> Last Quote Number:</label>
                        <input type="number" id="lastQuoteNum" value="0">
                    </div>

                    <div class="form-group">
                        <label for="lastOfferNum"><span>*</span> Last Offer Number:</label>
                        <input type="number" id="lastOfferNum" value="0">
                    </div>

                    <div class="form-group">
                        <label for="lastPaymentNum"><span>*</span> Last Payment Number:</label>
                        <input type="number" id="lastPaymentNum" value="0">
                    </div>

                </div>
                <button class="save-button">Save</button>
            </div>
        </div>
    </div>
    @endsection
   </div> 
    <script src="{{ asset('js/Setting.js') }}"></script>
</body>
</html>