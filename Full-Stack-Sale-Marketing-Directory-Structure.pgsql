Full-Stack-Sale-Marketing-Directory-Structure/ (with Laravel)
│
├── backend/
│   ├── app/
│   │   ├── console/
│   │   ├── Exceptions/
│   │   ├── Http/
│   │   │   ├── Controllers/                       
│   │   │   │   ├── Auth/
│   │   │   │   ├── CRM/
│   │   │   │   │   ├── LeadController.php
│   │   │   │	│   └── CustomerController.php
│   │   │   │   ├── Sales/
│   │   │   │   │   ├── DealController.php
│   │   │   │	│   └── QuotationController.php
│   │   │   │	└── marketings/
│   │   │   │       ├── CampaignController.php
│   │   │   │	    └── EmailController.php
│   │   │   └── Middleware/
│   │   │
│   ├── models/                          
│   │   ├── Lead.php
│   │   ├── Customer.php
│   │   ├── Deal.php
│   │   ├── Quotation.php
│   │   └── Campaign.php
│   ├── services/                          
│   │   ├── CompaignService.php
│   │   └── LeadService.php                  
│   └── providers/
│
├── database/
│   ├── factories/
│   │   ├── LeadFactory.php
│   │   ├── CustomerFactory.php
│   │   ├── DealFactory.php
│   │   ├── CampaignFactory.php
│   │   ├── CampaignLogFactory.php
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── create_leads_table.php
│   │   ├── create_customers_table.php
│   │   ├── create_deals_table.php
│   │   ├── create_campaigns_table.php
│   │   ├── create_campaign_logs_table.php
│   │   └── create_users_table.php 
│   └── seeders/
│		├── LeadSeeder.php
│		├── CustomerSeeder.php
│		├── DealSeeder.php
│		├── CampaignSeeder.php
│		├── CampainLogSeeder.php
│		└── DatabaseSeeder.php                              # Master seeder that calls them all
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php
│   │   ├── crm/
│   │   │   └── Leads.blade.php
│   │   ├── sales/
│   │   └── marketing/
│   ├── js/ 
│   └── sass/
│
├── public/
│   ├── css/
│   ├── js/
│   └── uploads/
├── config/
├── storage/
├── test/
├── .env
├── composer.json
└── README.md
