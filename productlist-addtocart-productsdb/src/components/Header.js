import React from "react";
import CartIcon from "./cart/CartIcon";
import { Navbar, Container, Nav } from "react-bootstrap"; // Using Nav for additional links

const Header = () => {
  return (
    <Navbar bg="primary" expand="lg" className="w-100 mb-4 shadow-sm">
      <Container>
        {/* Left side - Brand Name or Logo */}
        <Navbar.Brand href="/" className="text-white font-weight-bold fs-4">
          Product Management
        </Navbar.Brand>

        {/* Right side - Cart and additional links */}
        <Navbar id="navbar-nav" className="justify-content-end">
          <Nav className="d-flex align-items-center">

            {/* Cart Icon */}
            <div className="d-flex align-items-center">
              <CartIcon />
            </div>
          </Nav>
        </Navbar>
      </Container>
    </Navbar>
  );
};

export default Header;
