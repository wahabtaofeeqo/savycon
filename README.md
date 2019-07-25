# SavyCon

A platform where people find and post services for direct contact.

## How It Works
### Vendor (Freelancer)
- Registers and verifies the email address.
- Updates profile.
- Adds services.
- Share to social links.

### Buyer
- View services and contact vendor directly.
- Register and post a request for freelancers to apply.


## Tasks
#### Location discovery and mapping environment
- [ ] Get location API configuration
	- [x] Get latitude and longitude
	- [ ] Use position to get address
- [x] Address field in search

#### Auto Suggestion of Search keyword
- [ ] Add HTML datalist to search data

#### [Admin Dashboard](http://savycon.com/admin/dashboard)
- [x] Create middleware for admin
- [x] Seed admin details into database
- [ ] Write all features to add
	- [ ] Unfound Search
	- [ ] Services and 'Add New' (from Vendor)
		- View
		- Edit
		- Delete
		- Featured
		- Ban
		- Suspend
			- Open a modal to set datetime for suspension
	- [ ] Vendors
	- [ ] Users
	- [ ] Subscribers
	- [ ] Unresolved messages

#### General Additions
- [x] Average on reviews of user services
- [x] Register services in different locations
- [x] Post requests in different locations
- [x] Random view of services
- [x] Messages on Services
- [x] Random view services