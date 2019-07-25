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
- [ ] Add 'My Location [HOT]' to main navigation
- [ ] Get location API configuration
- [ ] Channel services with guest's location API on 'My Location' page
- [ ] Address field in search
	- Map to user_service 'address'

#### Auto Suggestion of Search keyword
- [ ] Add HTML datalist to search data

#### Admin Dashboard
- [ ] Review and make a list of functionalities -> [SavyCon Admin Dashboard](http://savycon.com/admin/dashboard)
- [ ] Create middleware for admin
- [ ] Seed admin details into database
- [ ] Write all features to add
	- [ ] Unfound Search
	- [ ] Services and 'Add New' (from Vendor)
		- View
		- Edit
		- Delete
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