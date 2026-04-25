"use client";

import { signIn } from "next-auth/react";
import { useState } from "react";

export default function AdminLoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  return (
    <div className="mx-auto max-w-md card space-y-4">
      <h1 className="text-2xl font-bold">Admin Login</h1>
      <input className="w-full rounded-xl border p-2" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)} />
      <input className="w-full rounded-xl border p-2" type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
      <button className="rounded-xl bg-brand-500 px-4 py-2 text-white" onClick={() => signIn("credentials", { email, password, callbackUrl: "/admin" })}>Sign in</button>
    </div>
  );
}
