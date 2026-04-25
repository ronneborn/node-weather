import { NextResponse } from "next/server";

export async function POST() {
  return NextResponse.json({ message: "Upload scaffolding ready. Connect S3 or local storage in production." }, { status: 501 });
}
