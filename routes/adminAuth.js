const express = require("express");
const router = express.Router();
const authController = require("../controllers/authController");
const adminMiddleware = require("../middleware/adminMiddleware");

// routes login
router.get("/login", authController.loginPage);
router.post("/login", authController.login);

// dashboard (protected)
router.get("/dashboard", adminMiddleware, authController.dashboard);

// logout
router.get("/logout", authController.logout);

module.exports = router;
