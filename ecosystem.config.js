module.exports = {
  apps: [
    {
      name: "currecy-converter",
      script: "npm",
      args: "start",
      cwd: "/var/www/currecy-converter",
      env: {
        NODE_ENV: "production",
        PORT: 3000
      }
    }
  ]
};
