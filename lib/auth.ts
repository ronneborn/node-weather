import NextAuth from "next-auth";
import Credentials from "next-auth/providers/credentials";
import { PrismaAdapter } from "@auth/prisma-adapter";
import { prisma } from "@/lib/prisma";
import bcrypt from "bcryptjs";

export const { handlers, auth, signIn, signOut } = NextAuth({
  adapter: PrismaAdapter(prisma),
  session: { strategy: "jwt" },
  pages: { signIn: "/admin/login" },
  providers: [
    Credentials({
      name: "Admin",
      credentials: { email: {}, password: {} },
      authorize: async (creds) => {
        const email = creds?.email as string;
        const password = creds?.password as string;
        if (!email || !password) return null;
        const user = await prisma.user.findUnique({ where: { email } });
        if (!user?.passwordHash) return null;
        const ok = await bcrypt.compare(password, user.passwordHash);
        return ok ? { id: user.id, email: user.email, name: user.name, role: user.role } : null;
      }
    })
  ],
  callbacks: {
    jwt: async ({ token, user }) => {
      if (user) token.role = (user as { role?: string }).role || "EDITOR";
      return token;
    },
    session: async ({ session, token }) => {
      if (session.user) (session.user as { role?: string }).role = token.role as string;
      return session;
    }
  }
});
