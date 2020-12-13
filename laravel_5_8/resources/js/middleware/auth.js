import { authHelper } from "../helpers"

export default function auth({ next, router }) {
  if (!authHelper.getAdminToken()) {
    return router.push({ name: "login" });
  }

  return next();
}
