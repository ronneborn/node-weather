import type { Metadata } from "next";
import "./globals.css";
import { Header } from "@/components/ui/header";
import { Footer } from "@/components/ui/footer";

export const metadata: Metadata = {
  metadataBase: new URL("https://currecy-converter.com"),
  title: { default: "Currency Converter & Exchange Rate Tools", template: "%s | currecy-converter.com" },
  description: "Live currency conversion, historical charts, and practical exchange-rate insights.",
  openGraph: { type: "website", siteName: "currecy-converter.com" },
  twitter: { card: "summary_large_image" }
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en">
      <body>
        <Header />
        <main className="container py-8">{children}</main>
        <Footer />
      </body>
    </html>
  );
}
