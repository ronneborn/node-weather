import { z } from "zod";

export const rateQuerySchema = z.object({
  from: z.string().length(3).transform((v) => v.toUpperCase()),
  to: z.string().length(3).transform((v) => v.toUpperCase())
});
