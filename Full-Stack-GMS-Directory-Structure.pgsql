Full-Stack-gallery-management-system-Directory-Structure/
│
├── backend/                                 # PHP backend (API-first architecture)
│   ├── config/                              # Environment config & DB connection
│   │   ├── config.php
│   │   ├── dbconnect.php
│   │   └── env.php
│   │
│   ├── core/                                # Core utilities and middleware
│   │   ├── Auth.php                         # Token-based auth middleware
│   │   ├── Validator.php                    # Input validation
│   │   ├── Response.php                     # Standardized API responses
│   │   └── Logger.php                       # Optional: logging support
│   │
│   ├── api/                                 # RESTful API endpoints
│   │   ├── common/
│   │   │   ├── Users.php
│   │   │   └── Roles.php
│   │   ├── admin/
│   │   │   ├── Artists.php
│   │   │   ├── Artworks.php
│   │   │   ├── Exhibitions.php
│   │   │   ├── Sales.php
│   │   │   └── Buyers.php
│   │   ├── gallery/
│   │   │   ├── Visitors.php
│   │   │   ├── ExhibitionArtworks.php
│   │   │   └── Purchases.php
│   │   ├── reports/
│   │   │   ├── SalesReport.php
│   │   │   └── VisitorReport.php
│   │   └── index.php                        # Optional: main API router entry
│   │
│   └── .htaccess                            # Apache routing (if used)
│
├── frontend/                                # Client-side (HTML, CSS, JS)
│   ├── common/                              # Reusable components
│   │   ├── css/
│   │   │   └── global.css
│   │   ├── js/
│   │   │   ├── utils.js
│   │   │   └── auth.js
│   │   └── components/                      # Optional: shared UI (navbar, modals, etc.)
│   │       ├── header.html
│   │       ├── footer.html
│   │       └── modal.html
│   │
│   ├── admin/                               # Admin panel UI
│   │   ├── dashboard.html
│   │   ├── css/
│   │   │   └── admin.css
│   │   ├── js/
│   │   │   ├── admin.js
│   │   │   ├── artist.js
│   │   │   ├── artwork.js
│   │   │   ├── exhibition.js
│   │   │   └── sales.js
│   │
│   ├── gallery/                             # Public gallery interface
│   │   ├── gallery-dashboard.html
│   │   ├── css/
│   │   │   └── gallery.css
│   │   ├── js/
│   │   │   ├── gallery.js
│   │   │   ├── exhibition.js
│   │   │   └── purchase.js
│   │
│   ├── assets/
│   │   ├── images/
│   │   │   └── logo.png
│   │   └── fonts/                           # Optional font assets
│   │
│   ├── uploads/                             # Uploaded images/artworks (public path)
│   └── README.md
│
├── database/                                # DB-related structure
│   ├── schema.sql
│   └── migrations/
│       ├── initial_schema.sql
│       └── seed_data.sql
│
├── docs/                                    # Technical documentation
│   ├── api-docs.md
│   ├── db-schema.md
│   ├── system-architecture.md
│   └── changelog.md
│
├── storage/                                 # Logs, temp files, etc.
│   ├── logs/
│   │   └── app.log
│   └── cache/
│
├── .env                                     # Environment variables (local only)
├── composer.json                            # PHP dependencies (if used)
├── .gitignore
└── README.md
