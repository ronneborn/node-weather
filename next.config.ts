import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  images: {
    remotePatterns: [{ protocol: "https", hostname: "**" }]
  },
  experimental: {
    serverActions: {
      allowedOrigins: ["currecy-converter.com", "www.currecy-converter.com"]
    }
  }
};

export default nextConfig;
