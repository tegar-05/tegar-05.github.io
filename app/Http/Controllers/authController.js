module.exports = {
    loginPage: (req, res) => {
        res.render("admin/login", { error: null });
    },

    login: (req, res) => {
        const { username, password } = req.body;

        // contoh hardcode—nanti bisa diganti database
        const adminUser = {
            username: "admin",
            password: "admin123"
        };

        if (username === adminUser.username && password === adminUser.password) {
            req.session.admin = true;
            return res.redirect("/admin/dashboard");
        }

        res.render("admin/login", { error: "Username atau password salah!" });
    },

    dashboard: (req, res) => {
        res.render("admin/dashboard");
    },

    logout: (req, res) => {
        req.session.destroy();
        res.redirect("/admin/login");
    }
};
